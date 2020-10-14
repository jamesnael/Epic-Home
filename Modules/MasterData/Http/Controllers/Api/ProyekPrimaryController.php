<?php

namespace Modules\MasterData\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\ProyekPrimary;
use Modules\MasterData\Entities\ProyekPrimaryDetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Modules\Core\Rules\SignedPhoneNumber;

class ProyekPrimaryController extends Controller
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
            $data = ProyekPrimary::create($request->all());


            if ($request->input('fasilitas_umum')) {
                $array_detail = (array) json_decode($request->input('fasilitas_umum'), true);
                foreach ($array_detail as $key => $value) {
                    $data->detail_fasilitas()->create([
                        'nama_fasilitas_umum' => $value['nama_fasilitas_umum'], 
                        'detail_fasilitas_umum' => $value['detail_fasilitas_umum'],
                        'jarak' => $value['jarak']
                    ]);
                }
            }

            if ($request->hasFile('google_map_gallery')) {
                $files = [];
                foreach ($request->file('google_map_gallery') ?? [] as $key => $file) {
                    $file_name = $data->nama_proyek . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs('proyek_primary/google_map_gallery', $file, $file_name
                    );
                    array_push($files, $file_name);
                }
                $data->google_map_gallery = json_encode($files);
                $data->save();

            }

            if ($request->hasFile('progress_update')) {
                $files = [];
                foreach ($request->file('progress_update') ?? [] as $key => $file) {
                    $file_name = $data->nama_proyek . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs('proyek_primary/progress_update', $file, $file_name
                    );
                    array_push($files, $file_name);
                }
                $data->progress_update = json_encode($files);
                $data->save();

            }

            if ($request->hasFile('banner_proyek')) {
                $file_name = $data->nama_proyek . '-' . uniqid() . '.' . $request->file('banner_proyek')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('proyek_primary/banner_proyek', $request->file('banner_proyek'), $file_name
                );
                $data->banner_proyek = $file_name;

            }

            if ($request->hasFile('product_knowledge')) {
                $file_name = $data->nama_proyek . '-' . uniqid() . '.' . $request->file('product_knowledge')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('proyek_primary/product_knowledge', $request->file('product_knowledge'), $file_name
                );
                $data->product_knowledge = $file_name;

            }
            $data->save();

            DB::commit();
            return response_json(true, null, 'Proyek primary berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param ProyekPrimary $proyek_primary
     * @return Renderable
     */
    public function update(Request $request, ProyekPrimary $proyek_primary)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors()->get(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $proyek_primary->update($request->all());

            $collection = collect($request->input('fasilitas_umum'));
            $id_detail = $collection->pluck('id');
            
            if (array_filter($id_detail->all())) {
                ProyekPrimaryDetail::where('id_proyek_primary', $proyek_primary->id)->whereNotIn('id', array_filter($id_detail->all()))->delete();
            } else {
                ProyekPrimaryDetail::where('id_proyek_primary', $proyek_primary->id)->delete();
            }

             if ($request->input('fasilitas_umum')) {
                $array_detail = (array) json_decode($request->input('fasilitas_umum'), true);
                foreach ($array_detail as $key => $value) {
                    if (isset($value['id'])) {
                        $proyek_primary->detail_fasilitas()->where('id', $value['id'])->update([
                            'nama_fasilitas_umum' => $value['nama_fasilitas_umum'], 
                            'detail_fasilitas_umum' => $value['detail_fasilitas_umum'],
                            'jarak' => $value['jarak'] 
                        ]);
                    } else {
                        $proyek_primary->detail_fasilitas()->create([
                            'nama_fasilitas_umum' => $value['nama_fasilitas_umum'], 
                            'detail_fasilitas_umum' => $value['detail_fasilitas_umum'],
                            'jarak' => $value['jarak']
                        ]);
                    }
                }
            }

            if ($request->hasFile('google_map_gallery')) {
                $files = [];
                foreach ($request->file('google_map_gallery') ?? [] as $key => $file) {
                    $file_name = $proyek_primary->nama_proyek . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs('proyek_primary/google_map_gallery', $file, $file_name
                    );
                    array_push($files, $file_name);
                }
                $proyek_primary->google_map_gallery = json_encode($files);
                $proyek_primary->save();

            }

            if ($request->hasFile('progress_update')) {
                $files = [];
                foreach ($request->file('progress_update') ?? [] as $key => $file) {
                    $file_name = $proyek_primary->nama_proyek . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs('proyek_primary/progress_update', $file, $file_name
                    );
                    array_push($files, $file_name);
                }
                $proyek_primary->progress_update = json_encode($files);
                $proyek_primary->save();

            }

            if ($request->hasFile('banner_proyek')) {
                $file_name = $proyek_primary->nama_proyek . '-' . uniqid() . '.' . $request->file('banner_proyek')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('proyek_primary/banner_proyek', $request->file('banner_proyek'), $file_name
                );
                $proyek_primary->banner_proyek = $file_name;

            }

            if ($request->hasFile('product_knowledge')) {
                $file_name = $proyek_primary->nama_proyek . '-' . uniqid() . '.' . $request->file('product_knowledge')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('proyek_primary/product_knowledge', $request->file('product_knowledge'), $file_name
                );
                $proyek_primary->product_knowledge = $file_name;

            }

            $proyek_primary->save();

            DB::commit();
            return response_json(true, null, 'Proyek primary berhasil disimpan.', $proyek_primary);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param ProyekPrimary $proyek_primary
     * @return Renderable
     */
    public function destroy(ProyekPrimary $proyek_primary)
    {
        DB::beginTransaction();
        try {
            $proyek_primary->delete();
            DB::commit();
            return response_json(true, null, 'Proyek primary dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menghapus data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Get the specified resource from storage.
     * @param ProyekPrimary $proyek_primary
     * @return Renderable
     */
    public function data(ProyekPrimary $proyek_primary)
    {
        $proyek_primary->url_banner_proyek = get_file_url('public', 'proyek_primary/banner_proyek/' . $proyek_primary->banner_proyek);
        
        $proyek_primary->url_product_knowledge = get_file_url('public', 'proyek_primary/product_knowledge/' . $proyek_primary->product_knowledge);

        $array_google_map_gallery = json_decode($proyek_primary->google_map_gallery, true);
        $google_map_galleries=[];
        foreach ($array_google_map_gallery as $key => $value) {
            array_push($google_map_galleries, get_file_url('public', 'proyek_primary/google_map_gallery/' . $value));
        }

        $proyek_primary->url_google_map_gallery = $google_map_galleries;

        $array_progress_update = json_decode($proyek_primary->progress_update, true);
        $files_progress_update=[];
        foreach ($array_progress_update as $key => $value) {
            array_push($files_progress_update, get_file_url('public', 'proyek_primary/progress_update/' . $value));
        }

        $proyek_primary->url_progress_update = $files_progress_update;

        return response_json(true, null, 'Data retrieved', $proyek_primary->load('detail_fasilitas'));
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
            'id_tipe_bangunan' => 'bail|required|exists:Modules\MasterData\Entities\TipeBangunan,id',
            'id_developer' => 'bail|required|exists:Modules\MasterData\Entities\Developer,id',
            'status_unit' => 'bail|required',
            'nama_proyek' => 'bail|required',
            'provinsi' => 'bail|required',
            'kota' => 'bail|required',
            'kabupaten' => 'bail|nullable',
            'alamat' => 'bail|nullable',
            'longitude' => 'bail|nullable',
            'latitude' => 'bail|nullable',
            'harga_awal' => 'bail|numeric',
            'nup' => 'bail|required|numeric',
            'utj' => 'bail|required|numeric',
            'komisi' => 'bail|required|numeric',
            'closing_fee' => 'bail|required|numeric',
            'reward' => 'bail|nullable',
            'jenis_pembayaran' => 'bail|required',
            'tahun_selesai' => 'bail|required',
            'estimasi_selesai' => 'bail|required',
            'lingkungan_sekitar' => 'bail|required',
            'jumlah_tower' => 'bail|required',
            'nomor_handphone' => ['bail', 'required', new SignedPhoneNumber],
            'copywriting' => 'bail|required',
            'banner_proyek' => 'bail|nullable',
            'product_knowledge' => 'bail|nullable',
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

        $query = ProyekPrimary::with('tipe_bangunan', 'tipe_proyek', 'developer');

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('nama_proyek', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('status_unit', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('tahun_selesai', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('harga_awal', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('nama_pic', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('nomor_handphone', 'LIKE', '%' . $request->input('search') . '%');
            });

            $query->orWhereHas('tipe_bangunan', function($subquery) use ($request) {
                $subquery->where('nama_tipe_bangunan', 'LIKE', '%' . $request->input('search') . '%');
            });

            $query->orWhereHas('tipe_proyek', function($subquery) use ($request) {
                $subquery->where('nama', 'LIKE', '%' . $request->input('search') . '%');
            });

            $query->orWhereHas('developer', function($subquery) use ($request) {
                $subquery->where('nama_developer', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $item->nama_tipe_proyek = $item->tipe_proyek->nama; 
            $item->nama_tipe_bangunan = $item->tipe_bangunan->nama_tipe_bangunan; 
            $item->nama_developer = $item->developer->nama_developer; 
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
