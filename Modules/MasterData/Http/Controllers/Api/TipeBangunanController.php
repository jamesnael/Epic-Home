<?php

namespace Modules\MasterData\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\TipeBangunan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TipeBangunanController extends Controller
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
            return response_json(false, $validator->errors()->get(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $data = TipeBangunan::create($request->all());
            DB::commit();
            return response_json(true, null, 'Tipe bangunan berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param TipeBangunan $tipe_bangunan
     * @return Renderable
     */
    public function update(Request $request, TipeBangunan $tipe_bangunan)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors()->get(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $tipe_bangunan->update($request->all());
            DB::commit();
            return response_json(true, null, 'Tipe bangunan berhasil disimpan.', $tipe_bangunan);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param TipeBangunan $tipe_bangunan
     * @return Renderable
     */
    public function destroy(TipeBangunan $tipe_bangunan)
    {
        DB::beginTransaction();
        try {
            $tipe_bangunan->delete();
            DB::commit();
            return response_json(true, null, 'Tipe bangunan dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menghapus data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Get the specified resource from storage.
     * @param TipeBangunan $tipe_bangunan
     * @return Renderable
     */
    public function data(TipeBangunan $tipe_bangunan)
    {
        return response_json(true, null, 'Data retrieved', $tipe_bangunan);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'nama_tipe_bangunan' => 'bail|required',
            'deskripsi' => 'bail|nullable'
        ]);
    }
}
