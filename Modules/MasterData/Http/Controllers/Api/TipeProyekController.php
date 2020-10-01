<?php

namespace Modules\MasterData\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\TipeProyek;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TipeProyekController extends Controller
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
            $data = TipeProyek::create($request->all());
            DB::commit();
            return response_json(true, null, 'Tipe proyek berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param TipeProyek $tipe_proyek
     * @return Renderable
     */
    public function update(Request $request, TipeProyek $tipe_proyek)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors()->get(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $tipe_proyek->update($request->all());
            DB::commit();
            return response_json(true, null, 'Tipe proyek berhasil disimpan.', $tipe_proyek);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param TipeProyek $tipe_proyek
     * @return Renderable
     */
    public function destroy(TipeProyek $tipe_proyek)
    {
        DB::beginTransaction();
        try {
            $tipe_proyek->delete();
            DB::commit();
            return response_json(true, null, 'Tipe proyek dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menghapus data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Get the specified resource from storage.
     * @param TipeProyek $tipe_proyek
     * @return Renderable
     */
    public function data(TipeProyek $tipe_proyek)
    {
        return response_json(true, null, 'Data retrieved', $tipe_proyek);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'nama' => 'bail|required',
            'deskripsi' => 'bail|nullable'
        ]);
    }
}
