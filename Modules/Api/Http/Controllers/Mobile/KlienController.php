<?php

namespace Modules\Api\Http\Controllers\Mobile;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
use Modules\Transaksi\Entities\Klien;
use Modules\ManageUser\Entities\Sales;
use Modules\Core\Rules\SignedPhoneNumber;
use Modules\Api\Notifications\VerifikasiEmailClient;

class KlienController extends Controller
{
    public function index(Request $request, $sales_slug)
    {
        $validator = $this->validateDataRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Get data failed.', $validator->errors()->first());
        }
        
        $sales = Sales::whereSlug($sales_slug)->first();
        if ($sales){
            $data  = Klien::where('sales_id', $sales->id)->orderBy('created_at', 'desc')->get();
        } else {
            return response_json(false, 'Get data failed.', $validator->errors()->first());
        }

        $data->transform(function($item) {
            return $item;
        });

        return response_json(true, null, 'Data retrieved.', $data);
    }

    /**
     *
     * Validation Rules for Get Data
     *
     */
    public function validateDataRequest($request)
    {
        return Validator::make($request->all(), [
            "paginate" => "bail|sometimes|required|numeric",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $request->merge([
                'telepone' => $request->input('nomor_hp'),
                'kode_otp' => $this->generateOTPCode()
            ]);

            $data = Klien::create($request->all());

            Notification::route('mail', $data->email)->notify(new VerifikasiEmailClient($data));

            log_activity(
                'Tambah klien ' . $data->nama_klien,
                $data
            );

            DB::commit();
            return response_json(true, null, 'Klien berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request, $id = null)
    {
        return Validator::make($request->all(), [
            'nama_klien' => 'bail|required|max:255',
            'sales_id' => 'bail|required|exists:Modules\ManageUser\Entities\Sales,id',
            'email' => "bail|required|email",
            'nomor_hp' => ['bail', 'required', new SignedPhoneNumber],
            'catatan' => 'bail|nullable',
            'nama_bank' => 'bail|nullable',
            'nomor_rekening' => 'bail|nullable|numeric',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function verifikasi(Request $request)
    {
        $validator = $this->validateVerificationRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        try {
            $klien = Klien::where('telepone', $request->input('nomor_hp'))->firstOrFail();
            log_activity(
                'Verifikasi OTP Register Klien ' . $klien->nama_klien,
                $klien,
                [
                    'verifikasi' => $request->all()
                ]
            );
            if ($klien->kode_otp == $request->input('kode_otp')) {
                // $date = now()->format('dMYHis');
                // $token = [
                //     'token_type' => 'Bearer',
                //     'access_token' => $klien->createToken('Token ' . $klien->telepone . '_' . $date)->accessToken,
                //     'expires_at' => \Carbon\Carbon::parse($date)->addDays(1)->toDateTimeString()
                // ];

                return response_json(true, null, 'Kode verifikasi berhasil diterima.', '');
            }
            throw new \Exception("Kode verifikasi Anda salah.");
        } catch (\Exception $e) {
            return response_json(false, 'InvalidOTPException', $e->getMessage());
        }
    }

    /**
     *
     * Validation Rules for Verifikasi OTP
     *
     */
    public function validateVerificationRequest($request)
    {
        return Validator::make($request->all(), [
            'nomor_hp' => [
                'bail',
                'required',
            ],
            'kode_otp' => 'bail|required|numeric',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function resend(Request $request)
    {
        $validator = $this->validateResendRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        try {
            $klien = Klien::where('telepone', $request->input('nomor_hp'))->firstOrFail();
            $klien->update([
                'kode_otp' => $this->generateOTPCode()
            ]);

            $data = $klien;
            Notification::route('mail', $data->email)->notify(new VerifikasiEmailClient($data));

            log_activity(
                'Resend Verifikasi OTP Register sales ' . $data->nama,
                $data
            );
            DB::commit();
            return response_json(true, null, 'Kode verifikasi berhasil dikirim.', $data->kode_otp);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     *
     * Validation Rules for Resend Verifikasi OTP
     *
     */
    public function validateResendRequest($request)
    {
        return Validator::make($request->all(), [
            'nomor_hp' => [
                'bail',
                'required',
            ],
        ]);
    }

    /**
     *
     * Generate kode OTP untuk sales
     *
     */
    public function generateOTPCode()
    {
        return rand(1000,9999);
    }
}
