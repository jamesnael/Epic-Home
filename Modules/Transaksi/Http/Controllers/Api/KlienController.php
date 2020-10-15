<?php

namespace Modules\Transaksi\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Transaksi\Entities\Klien;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Modules\Core\Rules\SignedPhoneNumber;

class KlienController extends Controller
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
            $data = Klien::create($request->all());

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
            'email' => "bail|required|email",
            'telepone' => ['bail', 'required', new SignedPhoneNumber],
            'catatan' => 'bail|nullable',
            'nama_bank' => 'bail|nullable',
            'nomor_rekening' => 'bail|nullable|numeric',
        ]);
    }
}
