<?php

namespace Modules\MasterData\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Unit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
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
            $data = Unit::create($request->all());

            if ($request->hasFile('gambar_unit')) {
                $file_gambar_units = $request->file('gambar_unit');
                foreach($file_gambar_units as $file_gambar_unit) {
                    $file_name = 'unit-' . uniqid() . '.' . $file_gambar_unit->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs('unit', $file_gambar_unit, $file_name
                    );
                    $array_file_gambar_unit[] = $file_name;
                }
                $data->gambar_unit = $array_file_gambar_unit;
            }
            $data->save();

            DB::commit();
            return response_json(true, null, 'Unit berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Unit $unit
     * @return Renderable
     */
    public function update(Request $request, Unit $unit)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors()->get(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $unit->update($request->all());
            
            if ($request->hasFile('gambar_unit')) {
                $file_gambar_units = $request->file('gambar_unit');
                foreach($file_gambar_units as $file_gambar_unit) {
                    $file_name = 'unit-' . uniqid() . '.' . $file_gambar_unit->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs('unit', $file_gambar_unit, $file_name
                    );
                    $array_file_gambar_unit[] = $file_name;
                }
                $data->gambar_unit = $array_file_gambar_unit;
            }
            $data->save();

            DB::commit();
            return response_json(true, null, 'Unit berhasil disimpan.', $unit);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Unit $unit
     * @return Renderable
     */
    public function destroy(Unit $unit)
    {
        DB::beginTransaction();
        try {
            $unit->delete();
            DB::commit();
            return response_json(true, null, 'Unit dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menghapus data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Get the specified resource from storage.
     * @param Unit $unit
     * @return Renderable
     */
    public function data(Unit $unit)
    {
        return response_json(true, null, 'Data retrieved', $unit);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'id_proyek_primari' => 'bail|required',
            'id_cluster' => 'bail|required',
            'tipe_unit' => 'bail|required',
            'harga_unit' => 'bail|required',
            'harga_per_meter' => 'bail|required',
            'blok' => 'bail|required',
            'nomor_unit' => 'bail|required',
            'luas_tanah' => 'bail|required',
            'luas_bangunan' => 'bail|required',
            'arah_bangunan' => 'bail|required',
            'jumlah_kamar_tidur' => 'bail|required',
            'jumlah_kamar_mandi' => 'bail|required',
            'jumlah_lantai' => 'bail|required',
            'jumlah_garasi_mobil' => 'bail|required',
            'listrik' => 'bail|required',
            'lebar_jalan_depan' => 'bail|required',
            'lingkungan_sekitar' => 'bail|required'
            'gambar_unit' => 'bail|nullable|image'
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

        $query = Unit::with('tipe_unit');

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('id_proyek_primari', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('blok', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('nomor_unit', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('luas_tanah', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('harga_unit', 'LIKE', '%' . $request->input('search') . '%');
            });

            $query->orWhereHas('tipe_unit', function($subquery) use ($request) {
                $subquery->where('nama_tipe_unit', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $item->last_update = $item->updated_at->locale('id')->translatedFormat('d F Y H:i');
            $item->nama_tipe_unit = $item->tipe_unit->nama ?? '';
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
