<?php

namespace Modules\MasterData\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\SecondaryUnit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SecondaryUnitController extends Controller
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

            $request->merge(['approved_status' => 'Pending']);

            $data = SecondaryUnit::create($request->all());
            // if ($request->hasFile('gallery_unit')) {
            //     $file_name = $data->nama_unit .'-'. uniqid() . '.' . $request->file('gallery_unit')->getClientOriginalExtension();
            //     Storage::disk('public')->putFileAs('SecondaryUnit/gallery_unit', $request->file('gallery_unit'), $file_name
            //     );
            //     $data->gallery_unit = $file_name;

            // }
            // $data->save();

             if ($request->hasFile('gallery_unit')) {
                $files = [];
                foreach ($request->file('gallery_unit') ?? [] as $key => $file) {
                    $file_name = $data->nama_unit . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs('secondary_unit/gallery_unit', $file, $file_name
                    );
                    array_push($files, $file_name);
                }
                $data->gallery_unit = json_encode($files);
                $data->save();

            }

            DB::commit();
            return response_json(true, null, 'Secondary unit berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }



    public function update(Request $request, SecondaryUnit $secondary_unit)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $secondary_unit->update($request->all());

         

            if ($request->hasFile('gallery_unit')) {
                $files = [];
                foreach ($request->file('gallery_unit') ?? [] as $key => $file) {
                    $file_name = $secondary_unit->nama_proyek . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs('secondary_unit/gallery_unit', $file, $file_name
                    );
                    array_push($files, $file_name);
                }
                $secondary_unit->gallery_unit = json_encode($files);
                $secondary_unit->save();

            }

            $secondary_unit->save();

            DB::commit();
            return response_json(true, null, 'Secondary unit berhasil disimpan.', $secondary_unit);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    

    public function destroy(SecondaryUnit $secondary_unit)
    {
        DB::beginTransaction();
        try {
            $secondary_unit->delete();
            DB::commit();
            return response_json(true, null, 'Secondary unit dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menghapus data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    

    public function data(SecondaryUnit $secondary_unit)
    {
        // $secondary_unit->url_gallery_unit = get_file_url('public', 'SecondaryUnit/gallery_unit/' . $secondary_unit->gallery_unit);

        $array_gallery_unit = json_decode($secondary_unit->gallery_unit, true);
        $files_gallery_unit=[];
        foreach ($array_gallery_unit as $key => $value) {
            array_push($files_gallery_unit, get_file_url('public', 'SecondaryUnit/gallery_unit/' . $value));
        }

        $secondary_unit->url_gallery_unit = $files_gallery_unit;

        return response_json(true, null, 'Data retrieved', $secondary_unit);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'nama_unit' => 'bail|required'
            
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

        $query = SecondaryUnit::with('tipe_bangunan')->where('approved_status', '!=', 'Disetujui');


        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('nama_unit', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('status_unit', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('luas_tanah', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('luas_bangunan', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('sertifikat', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('nama_pemilik', 'LIKE', '%' . $request->input('search') . '%');
                
            });

            $query->orWhereHas('tipe_bangunan', function($subquery) use ($request){
                $subquery->where('nama_tipe_bangunan', 'LIKE', '%'.$request->input('search').'%');
            });

        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $item->last_update = $item->updated_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');
            $item->tanggal_input = $item->created_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');
            $item->harga_unit ='Rp '.format_money($item->harga_unit);
            $item->nama_tipe_bangunan = $item->tipe_bangunan->nama_tipe_bangunan ?? '';
            return $item;
        });

        return response_json(true, null, 'Data retrieved.', $data);
    }

      public function tableApproved(Request $request)
    {
        $validator = $this->validateTableRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Isian form salah', $validator->errors()->first());
        }

        $query = SecondaryUnit::with('tipe_bangunan')->where('approved_status', 'Disetujui');


        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('nama_unit', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('status_unit', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('luas_tanah', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('luas_bangunan', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('sertifikat', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('nama_pemilik', 'LIKE', '%' . $request->input('search') . '%');
                
            });

            $query->orWhereHas('tipe_bangunan', function($subquery) use ($request){
                $subquery->where('nama_tipe_bangunan', 'LIKE', '%'.$request->input('search').'%');
            });

        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $item->last_update = $item->updated_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');
            $item->tanggal_input = $item->created_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');
            $item->harga_unit ='Rp '.format_money($item->harga_unit);
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
