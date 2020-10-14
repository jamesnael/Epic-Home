<?php

namespace Modules\MasterData\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Developer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DeveloperController extends Controller
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
            $data = Developer::create($request->all());
            if ($request->hasFile('logo_developer')) {
                $file_name = $data->nama_developer .'-'. uniqid() . '.' . $request->file('logo_developer')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('developer/logo_developer', $request->file('logo_developer'), $file_name
                );
                $data->logo_developer = $file_name;

            }
            $data->save();

            DB::commit();
            return response_json(true, null, 'Developer berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }



    public function update(Request $request, Developer $developer)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $developer->update($request->all());

            if ($request->hasFile('logo_developer')) {
                $file_name = $developer->nama_developer . '-' . uniqid() . '.' . $request->file('logo_developer')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('developer/logo_developer', $request->file('logo_developer'), $file_name
                );
                $developer->logo_developer = $file_name;

            }
            $developer->save();


            DB::commit();
            return response_json(true, null, 'Developer berhasil disimpan.', $developer);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    

    public function destroy(Developer $developer)
    {
        DB::beginTransaction();
        try {
            $developer->delete();
            DB::commit();
            return response_json(true, null, 'Developer property dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menghapus data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    

    public function data(Developer $developer)
    {
        $developer->url_logo_developer = get_file_url('public', 'developer/logo_developer/' . $developer->logo_developer);
        return response_json(true, null, 'Data retrieved', $developer);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'nama_developer' => 'bail|required',
            'email' => 'bail|required',
            'nomor_telepon' => 'bail|nullable',
            'alamat' => 'bail|nullable',
            'deskripsi' => 'bail|nullable',
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

        $query = Developer::query();

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('nama_developer', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('email', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('nomor_telepon', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('alamat', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('deskripsi', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
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
