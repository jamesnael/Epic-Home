<?php

namespace Modules\ManageUser\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ManageUser\Entities\Sales;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SalesController extends Controller
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
            $data = Sales::create($request->all());
           
            if ($request->hasFile('foto_ktp')) {
                $file_name = $data->nama_sales .'-'. uniqid() . '.' . $request->file('foto_ktp')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('sales/foto_ktp', $request->file('foto_ktp'), $file_name
                );
                $data->foto_ktp = $file_name;

            }

            if ($request->hasFile('foto_selfie')) {
                $file_name = $data->nama_sales .'-'. uniqid() . '.' . $request->file('foto_selfie')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('sales/foto_selfie', $request->file('foto_selfie'), $file_name
                );
                $data->foto_selfie = $file_name;

            }
            $data->save();

            DB::commit();
            return response_json(true, null, 'Sales berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }



    public function update(Request $request, Sales $sales)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors()->get(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $sales->update($request->all());

            if ($request->hasFile('foto_ktp')) {
                $file_name = $sales->nama_sales .'-'. uniqid() . '.' . $request->file('foto_ktp')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('sales/foto_ktp', $request->file('foto_ktp'), $file_name
                );
                $sales->foto_ktp = $file_name;

            }

              if ($request->hasFile('foto_selfie')) {
                $file_name = $sales->nama_sales .'-'. uniqid() . '.' . $request->file('foto_selfie')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('sales/foto_selfie', $request->file('foto_selfie'), $file_name
                );
                $sales->foto_selfie = $file_name;

            }

            $sales->save();


            DB::commit();
            return response_json(true, null, 'Sales berhasil disimpan.', $sales);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    

    public function destroy(Sales $sales)
    {
        DB::beginTransaction();
        try {
            $sales->delete();
            DB::commit();
            return response_json(true, null, 'Sales property dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menghapus data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    

    public function data(Sales $sales)
    {
        $sales->url_foto_ktp = get_file_url('public', 'sales/foto_ktp/' . $sales->foto_ktp);
        $sales->url_foto_selfie = get_file_url('public', 'sales/foto_selfie/' . $sales->foto_selfie);
        return response_json(true, null, 'Data retrieved', $sales);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'nama_sales' => 'bail|required',
            
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

        $query = Sales::where('status_sales', null);

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('nama_sales', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('email', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('nomor_telepon', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('alamat', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('deskripsi', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $item->tanggal_registrasi = $item->created_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');

            if ($item->status_sales == null) {
                $item->status_sales = "Pending";
            }

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

        $query = Sales::where('status_sales', '!=' , null,);

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('nama_sales', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('email', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('nomor_telepon', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('alamat', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('deskripsi', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $item->tanggal_registrasi = $item->created_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');
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
