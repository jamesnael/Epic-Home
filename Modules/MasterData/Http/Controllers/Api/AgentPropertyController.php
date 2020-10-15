<?php

namespace Modules\MasterData\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\AgentProperty;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Rules\SignedPhoneNumber;

class AgentPropertyController extends Controller
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
            $data = AgentProperty::create($request->all());
            if ($request->hasFile('logo_agent')) {
                $file_name = $data->nama_agent_property .'-'. uniqid() . '.' . $request->file('logo_agent')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('agent_property/logo_agent', $request->file('logo_agent'), $file_name
                );
                $data->logo_agent = $file_name;

            }
            $data->save();

            log_activity(
                'Tambah agent property ' . $data->nama_agent_property,
                $data
            );

            DB::commit();
            return response_json(true, null, 'Agent property berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param AgentProperty $agent_property
     * @return Renderable
     */
    public function update(Request $request, AgentProperty $agent_property)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $agent_property->update($request->all());

            if ($request->hasFile('logo_agent')) {
                $file_name = $agent_property->nama_agent_property . '-' . uniqid() . '.' . $request->file('logo_agent')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('agent_property/logo_agent', $request->file('logo_agent'), $file_name
                );
                $agent_property->logo_agent = $file_name;

            }
            $agent_property->save();

            log_activity(
                'Ubah agent property ' . $agent_property->nama_agent_property,
                $agent_property
            );


            DB::commit();
            return response_json(true, null, 'Agent property berhasil disimpan.', $agent_property);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param AgentProperty $agent_property
     * @return Renderable
     */
    public function destroy(AgentProperty $agent_property)
    {
        DB::beginTransaction();
        try {
            log_activity(
                'Hapus agent property ' . $agent_property->nama_agent_property,
                $agent_property
            );
            
            $agent_property->delete();
            DB::commit();
            return response_json(true, null, 'Agent property dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menghapus data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Get the specified resource from storage.
     * @param AgentProperty $agent_property
     * @return Renderable
     */
    public function data(AgentProperty $agent_property)
    {
        $agent_property->url_logo_agent = get_file_url('public', 'agent_property/logo_agent/' . $agent_property->logo_agent);
        return response_json(true, null, 'Data retrieved', $agent_property);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'nama_agent_property' => 'bail|required',
            'email' => 'bail|required',
            'nomor_telepon' => ['bail', 'nullable', new SignedPhoneNumber],
            'alamat => bail|nullable',
            'deskripsi => bail|nullable'
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

        $query = AgentProperty::query();

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('nama_agent_property', 'LIKE', '%' . $request->input('search') . '%');
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
