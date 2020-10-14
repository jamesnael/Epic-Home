<?php

namespace Modules\BeritaProperti\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BeritaProperti\Entities\BeritaProperti;
use Modules\BeritaProperti\Entities\TagBerita;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BeritaPropertiController extends Controller
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
            
            $array_tag = explode(',', $request->tag);
            foreach ($array_tag as $value_array_tag) {
                $data_tag[] = TagBerita::firstOrCreate(['nama' => $value_array_tag]);
            }

            $data = BeritaProperti::create($request->all());

            $data->tag = $array_tag;

            if ($request->hasFile('thumbnail')) {
                $file_thumbnail = $request->file('thumbnail');
                $file_name_thumbnail = 'thumbnail-' . uniqid() . '.' . $file_thumbnail->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('berita_properti/thumbnail', $file_thumbnail, $file_name_thumbnail
                    );
                $data->thumbnail = $file_name_thumbnail;
            }

            if ($request->hasFile('banner')) {
                $file_banners = $request->file('banner');
                foreach($file_banners as $file_banner) {
                    $file_name_banner = 'banner-' . $data->id . '-' . uniqid() . '.' . $file_banner->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs('berita_properti/banner', $file_banner, $file_name_banner
                    );
                    $array_file_banner[] = $file_name_banner;
                }
                $data->banner = $array_file_banner;
            }

            $data->save();

            DB::commit();
            return response_json(true, null, 'Berita properti berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param BeritaProperti $berita_properti
     * @return Renderable
     */
    public function update(Request $request, BeritaProperti $berita_properti)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors()->get(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {

            $array_tag = explode(',', $request->tag);
            foreach ($array_tag as $value_array_tag) {
                $data_tag[] = TagBerita::firstOrCreate(['nama' => $value_array_tag]);
            }

            $berita_properti->update($request->all());

            $berita_properti->tag = $array_tag;

            if ($request->hasFile('thumbnail')) {
                $file_thumbnail = $request->file('thumbnail');
                $file_name_thumbnail = 'thumbnail' . uniqid() . '.' . $file_thumbnail->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('berita_properti/thumbnail', $file_thumbnail, $file_name_thumbnail
                    );
                $berita_properti->thumbnail = $file_name_thumbnail;
            }

            if ($request->hasFile('banner')) {
                $file_banners = $request->file('banner');
                foreach($file_banners as $file_banner) {
                    $file_name_banner = 'banner-' . $berita_properti->id . '-' . uniqid() . '.' . $file_banner->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs('berita_properti/banner', $file_banner, $file_name_banner
                    );
                    $array_file_banner[] = $file_name_banner;
                }
                $berita_properti->banner = $array_file_banner;
            }

            $berita_properti->save();

            DB::commit();
            return response_json(true, null, 'Berita properti berhasil disimpan.', $berita_properti);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param BeritaProperti $berita_properti
     * @return Renderable
     */
    public function destroy(BeritaProperti $berita_properti)
    {
        DB::beginTransaction();
        try {
            $berita_properti->delete();
            DB::commit();
            return response_json(true, null, 'Berita properti dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menghapus data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Get the specified resource from storage.
     * @param BeritaProperti $berita_properti
     * @return Renderable
     */
    public function data(BeritaProperti $berita_properti)
    {
        $berita_properti->url_thumbnail = get_file_url('public', 'berita_properti/thumbnail/' . $berita_properti->thumbnail);

        $array_banner = $berita_properti->banner;
        $banners = [];
        foreach ($array_banner as $key => $value) {
            array_push($banners, get_file_url('public', 'berita_properti/banner/' . $value));
        }
        $berita_properti->url_banner = $banners;

        return response_json(true, null, 'Data retrieved', $berita_properti);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'judul' => 'bail|required|string',
            'tag' => 'bail|required',
            'deskripsi' => 'bail|nullable',
            'konten' => 'bail|nullable',
            'thumbnail' => 'bail|nullable',
            'banner' => 'bail|nullable',
            'penulis' => 'bail|nullable|string',
            'publish_date' => 'bail|nullable',
            'publish' => 'bail|nullable',
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

        $query = BeritaProperti::query();

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('judul', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('deskripsi', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $item->thumbnail = get_file_url('public', 'berita_properti/thumbnail/'.$item->thumbnail);
            if ($item->publish) {
                $item->publish = "Publish";
            } else {
                $item->publish = "Unpublish";
            }
            $item->publish_date = \Carbon\Carbon::parse($item->publish_date)->locale('id')->translatedFormat('d F Y');
            $item->last_update = $item->updated_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');
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
