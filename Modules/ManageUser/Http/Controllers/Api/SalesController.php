<?php

namespace Modules\ManageUser\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ManageUser\Entities\Sales;
use Modules\ManageUser\Entities\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Rules\SignedPhoneNumber;
use Illuminate\Validation\Rule;

class SalesController extends Controller
{
    public function update(Request $request, User $sales)
    {
        $validator = $this->validateFormRequest($request, $sales->id);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {

            $sales->update($request->only(['nama','email','telepon']));
            
            $data = $sales->sales;
            $data->update($request->all());

            if ($request->hasFile('foto_ktp')) {
                $file_name =  $sales->nama .'-'. uniqid() . '.' . $request->file('foto_ktp')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('sales/foto_ktp', $request->file('foto_ktp'), $file_name
                );
                $data->foto_ktp = $file_name;

            }

              if ($request->hasFile('foto_selfie')) {
                $file_name =  $sales->nama .'-'. uniqid() . '.' . $request->file('foto_selfie')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('sales/foto_selfie', $request->file('foto_selfie'), $file_name
                );
                $data->foto_selfie = $file_name;

            }

            $data->save();

            log_activity(
                'Ubah sales ' . $sales->nama,
                [
                    $sales,
                    $sales->sales
                ]
            );
            DB::commit();
            return response_json(true, null, 'Sales berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    public function destroy(User $sales)
    {
        DB::beginTransaction();
        try {
            log_activity(
                'Hapus sales ' . $sales->nama,
                [
                    $sales,
                    $sales->sales
                ]
            );
            $sales->sales->delete();
            $sales->delete();
            DB::commit();
            return response_json(true, null, 'Sales berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menghapus data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    public function data(User $sales)
    {
        $data = $sales->load('sales');
        $data->sales->url_foto_ktp = get_file_url('public', 'sales/foto_ktp/' . $data->sales->foto_ktp);
        $data->sales->url_foto_selfie = get_file_url('public', 'sales/foto_selfie/' . $data->sales->foto_selfie);

        return response_json(true, null, 'Data retrieved', $data);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request, $id = null)
    {
        return Validator::make($request->all(), [
            'nama' => 'bail|required',
            'email' => [
                'bail', 
                'nullable', 
                'email', 
                Rule::unique('\Modules\ManageUser\Entities\User', 'email')
                    ->where(function ($query) {
                        return $query->where('is_sales', true)->whereNull('deleted_at');
                    })
                    ->ignore($id)
            ],
            'telepon' => [
                'bail', 
                'required', 
                new SignedPhoneNumber, 
                Rule::unique('\Modules\ManageUser\Entities\User', 'telepon')
                    ->where(function ($query) {
                        return $query->where('is_sales', true)->whereNull('deleted_at');
                    })
                    ->ignore($id)
            ],
            'no_telepon_agent_referensi' => [
                'bail', 
                'nullable', 
                new SignedPhoneNumber,
            ],
            'tipe_agent' => 'bail|nullable|in:' . implode(',', decode_option('manageuser.tipe_agent')),
            'kantor_agent' => 'bail|required_if:tipe_agent,Agent Property|nullable|exists:\Modules\MasterData\Entities\AgentProperty,id',
            'nama_depan' => 'bail|nullable',
            'nama_belakang' => 'bail|nullable',
            'no_ktp' => 'bail|nullable|numeric',
            'jenis_kelamin' => 'bail|nullable|in:' . implode(',', decode_option('manageuser.jenis_kelamin')),
            'tempat_lahir' => 'bail|nullable',
            'tanggal_lahir' => 'bail|nullable|date_format:Y-m-d',
            'alamat' => 'bail|nullable',
            'provinsi' => 'bail|nullable',
            'kota' => 'bail|nullable',
            'kecamatan' => 'bail|nullable',
            'kelurahan' => 'bail|nullable',
            'rt' => 'bail|nullable',
            'rw' => 'bail|nullable',
            'no_rekening' => 'bail|nullable',
            'nama_rekening' => 'bail|nullable',
            'bank' => 'bail|nullable',
            'no_npwp' => 'bail|nullable',
            'note' => 'bail|nullable',
            'foto_ktp' => 'bail|nullable',
            'foto_selfie' => 'bail|nullable',
            'status_sales' => 'bail|required|in:' . implode(',', decode_option('manageuser.status_sales'))
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

        $query = User::with('sales')->whereHas('sales',  function($subquery){
            $subquery->where('status_sales', '!=', 'Sudah Diverifikasi');
        })->isSales();

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('nama', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('email', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('telepon', 'LIKE', '%' . $request->input('search') . '%');
            });

            $query->orWhereHas('sales', function($subquery) use ($request) {
                $subquery->where('tipe_agent', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('no_telepon_agent_referensi', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('nama_depan', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('nama_belakang', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('jenis_kelamin', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $item->tanggal_registrasi = $item->created_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');
            $item->no_telepon_agent_referensi = $item->sales->no_telepon_agent_referensi;
            $item->tipe_agent = $item->sales->tipe_agent;
            $item->nama_agent_property = $item->sales->kantor_agen->nama_agent_property ?? '';
            $item->logo_agent = $item->sales->kantor_agen->logo_agent ?? '';
            $item->jenis_kelamin = $item->sales->jenis_kelamin;
            $item->status_sales = $item->sales->status_sales;

            if ($item->status_sales == '') {
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

        $query = User::with('sales')->whereHas('sales',  function($subquery){
            $subquery->where('status_sales', 'Sudah Diverifikasi');
        })->isSales();

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('nama', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('email', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('telepon', 'LIKE', '%' . $request->input('search') . '%');
            });

            $query->orWhereHas('sales', function($subquery) use ($request) {
                $subquery->where('tipe_agent', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('no_telepon_agent_referensi', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('nama_depan', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('nama_belakang', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('jenis_kelamin', 'LIKE', '%' . $request->input('search') . '%');
            });
        }

        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $item->tanggal_registrasi = $item->created_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');
            $item->no_telepon_agent_referensi = $item->sales->no_telepon_agent_referensi;
            $item->tipe_agent = $item->sales->tipe_agent;
            $item->nama_agent_property = $item->sales->kantor_agen->nama_agent_property ?? '';
            $item->logo_agent = $item->sales->kantor_agen->logo_agent ?? '';
            $item->jenis_kelamin = $item->sales->jenis_kelamin;
            $item->status_sales = $item->sales->status_sales;
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
