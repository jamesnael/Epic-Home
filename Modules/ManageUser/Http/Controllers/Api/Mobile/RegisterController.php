<?php

namespace Modules\ManageUser\Http\Controllers\Api\Mobile;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ManageUser\Entities\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Modules\Core\Rules\SignedPhoneNumber;
use Illuminate\Support\Facades\Notification;
use Modules\ManageUser\Notifications\VerifikasiEmailUser;
use Modules\Transaksi\Notifications\VerifikasiEmailKlien;

class RegisterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function register(Request $request)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $request->merge([
                'is_sales' => true,
                'status_sales' => 'Pending',
                'telepon' => $request->input('nomor_hp'),
                'no_telepon_agent_referensi' => $request->input('nomor_referensi'),
            ]);
            
            $data = User::create($request->only(['nama','telepon', 'kode_otp', 'is_sales']));
            $data->kode_otp = $this->generateOTPCode('mail', $data->email, 'User', $data);
            $data->save();
            
            $sales = $data->sales()->create($request->all());
            
            log_activity(
                'Register sales ' . $data->nama,
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
     * Validation Rules for Register Sales
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'nama' => 'bail|required',
            'nomor_hp' => [
                'bail', 
                'required', 
                new SignedPhoneNumber, 
                Rule::unique('\Modules\ManageUser\Entities\User', 'telepon')
                    ->where(function ($query) {
                        return $query->where('is_sales', true)->whereNull('deleted_at');
                    })
            ],
            'nomor_referensi' => ['bail', 'nullable', new SignedPhoneNumber],
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
            $user = User::isSales()->where('telepon', $request->input('nomor_hp'))->firstOrFail();
            log_activity(
                'Verifikasi OTP Register sales ' . $user->nama,
                $user,
                [
                    'verifikasi' => $request->all()
                ]
            );
            if ($user->kode_otp == $request->input('kode_otp')) {
                $date = now()->format('dMYHis');
                $token = [
                    'token_type' => 'Bearer',
                    'access_token' => $user->createToken('Token ' . $user->telepon . '_' . $date)->accessToken,
                    'expires_at' => \Carbon\Carbon::parse($date)->addDays(1)->toDateTimeString()
                ];

                return response_json(true, null, 'Kode Verifikasi berhasil diterima.', $token);
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
                Rule::exists('\Modules\ManageUser\Entities\User', 'telepon')
                    ->where(function ($query) {
                        return $query->where('is_sales', true)->whereNull('deleted_at');
                    })
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
            $user = User::isSales()->where('telepon', $request->input('nomor_hp'))->firstOrFail();
            $user->update([
                'kode_otp' => $this->generateOTPCode('mail', $user->email, 'User', $user)
            ]);

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
                Rule::exists('\Modules\ManageUser\Entities\User', 'telepon')
                    ->where(function ($query) {
                        return $query->where('is_sales', true)->whereNull('deleted_at');
                    })
            ],
        ]);
    }

    /**
     *
     * Generate kode OTP untuk sales
     *
     */
    public function generateOTPCode($driver = 'mail', $to, $type = 'User', $data = null)
    {
        if ($type == 'User') {
            Notification::route($driver, $to)->notify(new VerifikasiEmailUser($data));
        } elseif ($type == 'Klien') {
            Notification::route($driver, $to)->notify(new VerifikasiEmailKlien($data));
        }

        return rand(1000,9999);
    }
}
