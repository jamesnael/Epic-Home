<?php

namespace Modules\Transaksi\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Transaksi\Entities\TitipJualSewa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class TitipJualSewaController extends Controller
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
            $data = TitipJualSewa::create($request->all());

            if ($request->hasFile('gallery_unit')) {
                foreach ($request->file('gallery_unit') ?? [] as $key => $file) {
                    $file_name = $data->nama_pemilik . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs('titip_jual_sewa/gallery_unit', $file, $file_name
                    );
                    $files[] = $file_name;
                }
                $data->gallery_unit = $files;
                $data->save();

            }

            DB::commit();
            return response_json(true, null, 'Titip jual atau sewa unit berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param TitipJualSewa $titip_jual_sewa
     * @return Renderable
     */
    public function update(Request $request, TitipJualSewa $titip_jual_sewa)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $titip_jual_sewa->update($request->only('status'));

            DB::commit();
            return response_json(true, null, 'Titip jual atau sewa unit berhasil disimpan.', $titip_jual_sewa);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param TitipJualSewa $titip_jual_sewa
     * @return Renderable
     */
    public function destroy(TitipJualSewa $titip_jual_sewa)
    {
        DB::beginTransaction();
        try {
            $titip_jual_sewa->delete();
            DB::commit();
            return response_json(true, null, 'Titip jual atau sewa unit berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menghapus data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Get the specified resource from storage.
     * @param TitipJualSewa $titip_jual_sewa
     * @return Renderable
     */
    public function data(TitipJualSewa $titip_jual_sewa)
    {
        $array_gallery_unit = $titip_jual_sewa->gallery_unit;
        $gallery_units=[];
        foreach ($array_gallery_unit ?? [] as $key => $value) {
            array_push($gallery_units, get_file_url('public', 'titip_jual_sewa/gallery_unit/' . $value));
        }

        $titip_jual_sewa->url_gallery_unit = $gallery_units ?? [];
        return response_json(true, null, 'Data retrieved', $titip_jual_sewa);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'id_tipe_bangunan' => 'bail|required|exists:Modules\MasterData\Entities\TipeBangunan,id',
            'telepone' => 'bail|nullable',
            'kebutuhan' => 'bail|nullable',
            'provinsi' => 'bail|nullable',
            'kota' => 'bail|nullable',
            'alamat' => 'bail|nullable',
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

        $query = TitipJualSewa::with('tipe_bangunan')->whereIn('status', ['', 'Pending']);

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('nama', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('deskripsi', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $item->tanggal_input = $item->created_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');
            $item->nama_tipe_bangunan = $item->tipe_bangunan->nama_tipe_bangunan ?? '';
            return $item;
        });

        return response_json(true, null, 'Data retrieved.', $data);
    }

    /**
     *
     * Get the resources from storage.
     * @return Renderable
     *
     */
    public function tableSucess(Request $request)
    {
        $validator = $this->validateTableRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Isian form salah', $validator->errors()->first());
        }

        $query = TitipJualSewa::with('tipe_bangunan')->where('status', 'Terjual');

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('nama', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('deskripsi', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $item->tanggal_input = $item->created_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');
            $item->nama_tipe_bangunan = $item->tipe_bangunan->nama_tipe_bangunan ?? '';
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
