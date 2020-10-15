<?php

namespace Modules\MasterData\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Bank;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BankController extends Controller
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

            if($request->has('flat_suku_bunga')){
                $request->merge(['flat_suku_bunga' => true]);
            }
            $data = Bank::create($request->all());

            log_activity(
                'Tambah bank ' . $data->nama_bank,
                $data
            );

            DB::commit();
            return response_json(true, null, 'Bank berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Bank $bank
     * @return Renderable
     */
    public function update(Request $request, Bank $bank)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {

            if ($request->has('flat_suku_bunga')) {
                $request->merge(['flat_suku_bunga' => true]);
            } else {
                $request->merge(['flat_suku_bunga' => false]);
            }
            $bank->update($request->all());

            log_activity(
                'Ubah bank ' . $bank->nama_bank,
                $bank
            );
            DB::commit();
            return response_json(true, null, 'Bank berhasil disimpan.', $bank);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Bank $bank
     * @return Renderable
     */
    public function destroy(Bank $bank)
    {
        DB::beginTransaction();
        try {
            log_activity(
                'Hapus bank ' . $bank->nama_bank,
                $bank
            );
            
            $bank->delete();
            DB::commit();
            return response_json(true, null, 'Bank dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menghapus data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Get the specified resource from storage.
     * @param Bank $bank
     * @return Renderable
     */
    public function data(Bank $bank)
    {
        return response_json(true, null, 'Data retrieved', $bank);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'nama_bank' => 'bail|required',
            'jenis_bank' => 'bail|required|in:' . implode(',', decode_option('masterdata.jenis_bank')),
            'nama_pinjaman' => 'bail|nullable',
            'suku_bunga' => 'bail|nullable',
            'masa_kredit' => 'bail|nullable',
            'tenor_mulai_dari' => 'bail|nullable',
            'tenor_sampai_dengan' => 'bail|nullable',
            'status' => 'bail|required|in:' . implode(',', decode_option('masterdata.status')),
            'flat_suku_bunga' => 'bail|nullable'
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

        $query = Bank::query();

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('nama_bank', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('deskripsi', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $item->last_update = $item->updated_at->locale('id')->translatedFormat('d F Y H:i');
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
