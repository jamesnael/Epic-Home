<?php

namespace Modules\MasterData\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\TipeUnit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TipeUnitController extends Controller
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
            $data = TipeUnit::create($request->all());
            DB::commit();
            return response_json(true, null, 'Tipe unit berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param TipeUnit $tipe_unit
     * @return Renderable
     */
    public function update(Request $request, TipeUnit $tipe_unit)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors()->get(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $tipe_unit->update($request->all());
            DB::commit();
            return response_json(true, null, 'Tipe unit berhasil disimpan.', $tipe_unit);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param TipeUnit $tipe_unit
     * @return Renderable
     */
    public function destroy(TipeUnit $tipe_unit)
    {
        DB::beginTransaction();
        try {
            $tipe_unit->delete();
            DB::commit();
            return response_json(true, null, 'Tipe unit dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menghapus data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Get the specified resource from storage.
     * @param TipeUnit $tipe_unit
     * @return Renderable
     */
    public function data(TipeUnit $tipe_unit)
    {
        return response_json(true, null, 'Data retrieved', $tipe_unit);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'id_tipe_proyek' => 'bail|required|exists:Modules\MasterData\Entities\TipeProyek,id',
            'nama_tipe_unit' => 'bail|required',
            'deskripsi' => 'bail|nullable'
        ]);
    }

}
