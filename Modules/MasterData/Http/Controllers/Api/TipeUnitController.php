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
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $data = TipeUnit::create($request->all());
            log_activity(
                'Tambah tipe unit ' . $data->nama_tipe_unit,
                $data
            );

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
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $tipe_unit->update($request->all());

            log_activity(
                'Ubah tipe unit ' . $tipe_unit->nama_tipe_unit,
                $tipe_unit
            );

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
            log_activity(
                'Hapus tipe unit ' . $tipe_unit->nama_tipe_unit,
                $tipe_unit
            );

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
            'id_proyek_primary' => 'bail|required|exists:Modules\MasterData\Entities\ProyekPrimary,id',
            'nama_tipe_unit' => 'bail|required',
            'deskripsi' => 'bail|nullable'
        ]);
    }

    /**
     *
     * Get the resources from storage.
     * @return Renderable
     *
     */
    public function table(Request $request)
    {
        $validator = $this->validateTableRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Isian form salah', $validator->errors()->first());
        }

        $query = TipeUnit::with('proyek_primary');

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('nama_tipe_unit', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('deskripsi', 'LIKE', '%' . $request->input('search') . '%');
            });

            $query->orWhereHas('proyek_primary', function($subquery) use ($request) {
                $subquery->where('nama_proyek', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $item->last_update = $item->updated_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');
            $item->nama_proyek_primary = $item->proyek_primary->nama_proyek ?? '';
            return $item;
        });

        return response_json(true, null, 'Data retrieved.', $data);
    }

    /**
     *
     * Validation Rules for Get Table Data
     *
     */
    public function validateTableRequest($request)
    {
        return Validator::make($request->all(), [
            "page" => "bail|sometimes|required|numeric|min:1",
            "search" => "bail|present|nullable",
            "paginate" => "bail|required|numeric|in:10,20,50,100",
        ]);
    }

}
