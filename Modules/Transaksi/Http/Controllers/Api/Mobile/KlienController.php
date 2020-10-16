<?php

namespace Modules\Transaksi\Http\Controllers\Api\Mobile;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Transaksi\Entities\Klien;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Modules\Core\Rules\SignedPhoneNumber;
use Modules\ManageUser\Http\Controllers\Api\Mobile\RegisterController as OtpRegisterController;
use Illuminate\Support\Facades\Notification;
use Modules\Transaksi\Notifications\VerifikasiEmailKlien;


class KlienController extends Controller
{
    /**
     * KlienController constructor.
     *
     */
    public function __construct()
    {
        $this->otp = new OtpRegisterController;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function storeClient(Request $request)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $request->merge([
                'kode_otp' => $this->otp->generateOTPCode()
            ]);

            $klien = Klien::create($request->all());

            Notification::route('mail', $klien->email)->notify(new VerifikasiEmailKlien($klien));
            
            log_activity(
                'Tambah klien ' . $klien->nama_klien,
                $klien
            );

            DB::commit();
            return response_json(true, null, 'Klien berhasil disimpan.', $klien);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Get client list.
     * @param Request $request
     * @return Renderable
     */
    public function getClientList(Request $request)
    {
        $data = Klien::where('is_verified', true)->paginate($request->input('paginate') ?? 10);

        return response_json(true, null, 'Data retrieved.', $data);
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
            $klien = Klien::where('email', $request->input('email'))->firstOrFail();

            log_activity(
                'Verifikasi OTP klien ' . $klien->nama_klien,
                $klien,
                [
                    'verifikasi' => $request->all()
                ]
            );

            if ($klien->kode_otp == $request->input('kode_otp')) {
                $klien->is_verified = true;
                $klien->save();

                return response_json(true, null, 'Kode Verifikasi berhasil diterima.', $klien);
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
            'email'  => 'bail|required|exists:Modules\Transaksi\Entities\Klien,email',
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
            $klien = Klien::where('email', $request->input('email'))->firstOrFail();
            $klien->update([
                'kode_otp' => $this->otp->generateOTPCode()
            ]);

            Notification::route('mail', $klien->email)->notify(new VerifikasiEmailKlien($klien));

            log_activity(
                'Resend Verifikasi OTP klien ' . $klien->nama,
                $klien
            );
            DB::commit();
            return response_json(true, null, 'Kode verifikasi berhasil dikirim.', $klien->kode_otp);
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
            'email'  => 'bail|required|exists:Modules\Transaksi\Entities\Klien,email',
        ]);
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
            'email' => "bail|sometimes|required|email|unique:Modules\Transaksi\Entities\Klien,email,$id,id,deleted_at,NULL",
            'telepone' => ['bail', 'required', new SignedPhoneNumber],
            'catatan' => 'bail|nullable',
            'nama_bank' => 'bail|nullable',
            'nomor_rekening' => 'bail|nullable|numeric',
        ]);
    }


}
