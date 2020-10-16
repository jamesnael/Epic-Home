<?php

namespace Modules\ManageUser\Http\Controllers\Api\Frontend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ManageUser\Entities\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Modules\Core\Rules\SignedPhoneNumber;
use Modules\ManageUser\Http\Controllers\Api\Mobile\RegisterController;

class RegisterController extends Controller
{
    /**
     * UserController constructor.
     *
     */
    public function __construct()
    {
        $this->otp = new RegisterController;
    }

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
                'is_customer' => true,
                'telepon' => $request->input('nomor_hp'),
                'kode_otp' => $this->otp->generateOTPCode()
            ]);
            
            $data = User::create($request->only(['nama','telepon', 'kode_otp', 'is_customer']));
            
            log_activity(
                'Register customer ' . $data->nama,
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
     * Validation Rules for Register customer
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
                        return $query->where('is_customer', true)->whereNull('deleted_at');
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
            $user = User::isCustomer()->where('telepon', $request->input('nomor_hp'))->firstOrFail();
            log_activity(
                'Verifikasi OTP Register customer ' . $user->nama,
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
                        return $query->where('is_customer', true)->whereNull('deleted_at');
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
            $user = User::isCustomer()->where('telepon', $request->input('nomor_hp'))->firstOrFail();
            $user->update([
                'kode_otp' => $this->otp->generateOTPCode()
            ]);
            log_activity(
                'Resend Verifikasi OTP Register customer ' . $user->nama,
                $user
            );
            DB::commit();
            return response_json(true, null, 'Kode verifikasi berhasil dikirim.', $user->kode_otp);
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
                        return $query->where('is_customer', true)->whereNull('deleted_at');
                    })
            ],
        ]);
    }
}
