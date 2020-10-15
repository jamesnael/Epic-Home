<?php

namespace Modules\ManageUser\Http\Controllers\Api\Mobile;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ManageUser\Entities\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Modules\Core\Rules\SignedPhoneNumber;

class LoginController extends Controller
{
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
            $data = User::isSales()->where('telepon', $request->input('nomor_hp'))->firstOrFail();
            $token = [
                'token_type' => 'Bearer',
                'access_token' => $data->accessToken,
                'expires_at' => \Carbon\Carbon::parse($data->token->expires_at)->toDateTimeString(),
            ];
            return response_json(true, null, 'Kode verifikasi berhasil dikirim.', $token);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     *
     * Validation Rules for Login
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'nomor_hp' => ['bail', 'required', new SignedPhoneNumber],
        ]);
    }
}
