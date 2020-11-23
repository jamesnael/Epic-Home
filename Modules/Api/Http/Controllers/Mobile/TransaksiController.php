<?php

namespace Modules\Api\Http\Controllers\Mobile;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
use Modules\Transaksi\Entities\TransaksiPemesanan;

class TransaksiController extends Controller
{
   public function index(Request $request, $transaksi_slug)
    {
        $validator = $this->validateDataRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Invalid form data', $validator->errors()->first());
        }

        $query = TransaksiPemesanan::whereSlug($transaksi_slug)->first();
        
        $data = $query->paginate($request->input('paginate') ?? 10);
        $data->getCollection()->transform(function($item) {
            return collect($item);
        });
        return response_json(true, null, 'Data retrieved.', $data);
    }

     public function validateDataRequest($request)
    {
        return Validator::make($request->all(), [
            'paginate' => 'bail|sometimes|required|numeric|min:10',
        ]);
    }
   


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Isian form salah', $validator->errors()->first());
        }

        DB::beginTransaction();
        try {

            $data = TransaksiPemesanan::create($request->all());

            DB::commit();
            return response_json(true, null, 'Berhasil melakukan transaksi.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

     public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            "id_klien" => "bail|required|exists:Modules\Transaksi\Entities\Klien,id",
            "id_unit" => "bail|required|exists:Modules\MasterData\Entities\Unit,id",
            "perihal_pembayaran" => "bail|required",
            "jumlah_bayar" => "bail|required",
            "terbilang" => "bail|required",
            "keterangan" => "bail|nullable",
            "status" => "bail|required",
            "cara_bayar" => "bail|required",
            "deskripsi_pembayaran" => "bail|nullable"
        ]);
    }
  
}
