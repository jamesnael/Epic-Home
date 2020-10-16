<?php

namespace Modules\ManageUser\Http\Controllers\Api\Mobile;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ManageUser\Http\Controllers\Helper\SalesHelper as Controller;
use Modules\MasterData\Entities\AgentProperty;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * UserController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    /**
     *
     * Return Form Helper
     *
     */
    public function getHelper()
    {
        return [
            'tipe_agent' => json_decode(option('manageuser.tipe_agent', json_encode([]))),
            'kantor_agent' => AgentProperty::get(),
            'jenis_kelamin' => json_decode(option('manageuser.jenis_kelamin', json_encode([]))),
            'provinsi' => [],
            'kota' => [],
            'kecamatan' => [],
            'kelurahan' => [],
        ];
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function updateProfile(Request $request)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $user = Auth::user();
            $user->update(['email' => $request->input('email')]);

            if ($request->hasFile('image_foto_ktp')) {
                $request->merge([
                    'foto_ktp' => 'ktp_' . Str::snake($user->slug) . '_' . uniqid() . '.' . $request->file('image_foto_ktp')->getClientOriginalExtension(),
                ]);
                Storage::disk('public')->putFileAs(
                    'document/' . $user->slug, $request->file('image_foto_ktp'), $request->input('foto_ktp')
                );
            }

            if ($request->hasFile('image_foto_selfie')) {
                $request->merge([
                    'foto_selfie' => 'selfie_' . Str::snake($user->slug) . '_' . uniqid() . '.' . $request->file('image_foto_selfie')->getClientOriginalExtension(),
                ]);
                Storage::disk('public')->putFileAs(
                    'document/' . $user->slug, $request->file('image_foto_selfie'), $request->input('foto_selfie')
                );
            }

            $user->sales->update($request->except(['email', 'image_foto_ktp', 'image_foto_selfie']));

            DB::commit();
            return response_json(true, null, 'Data diri berhasil disimpan.', $data);
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
            // 'nama_depan' => 'bail|required',
            // 'nama_belakang' => 'bail|nullable',
            'email' => 'bail|required|email',
            'tipe_agent' => 'bail|nullable|in:' . implode(',', decode_option('manageuser.tipe_agent')),
            'kantor_agent' => 'bail|required_if:tipe_agent,Agent Property|nullable|exists:\Modules\MasterData\Entities\AgentProperty,id',
            'no_ktp' => 'bail|required|numeric',
            'jenis_kelamin' => 'bail|nullable|in:' . implode(',', decode_option('manageuser.jenis_kelamin')),
            'tempat_lahir' => 'bail|nullable',
            'tanggal_lahir' => 'bail|nullable|date_format:Y-m-d',
            'alamat' => 'bail|required',
            'provinsi' => 'bail|required',
            'kota' => 'bail|required',
            'kecamatan' => 'bail|required',
            'kelurahan' => 'bail|required',
            'rt' => 'bail|nullable|numeric',
            'rw' => 'bail|nullable|numeric',
            'no_npwp' => 'bail|required|numeric',
            'image_foto_ktp' => 'bail|sometimes|image',
            'image_foto_selfie' => 'bail|sometimes|image',
        ]);
    }
}
