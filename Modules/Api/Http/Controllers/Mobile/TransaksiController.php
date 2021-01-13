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
use Modules\MasterData\Entities\Unit;

class TransaksiController extends Controller
{
    public function index(Request $request, $sales_slug)
    {
        $validator = $this->validateDataRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Invalid form data', $validator->errors()->first());
        }

        $data = TransaksiPemesanan::with('unit','klien')->whereHas('klien.sales', function($subquery) use ($sales_slug){
            $subquery->where('slug', $sales_slug);

        })->get();
        
        $data->transform(function($item) {
            return ($item);
        });
        return response_json(true, null, 'Data retrieved.', $data);
    }



   public function detail(Request $request, $transaksi_slug)
    {
        $validator = $this->validateDataRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Invalid form data', $validator->errors()->first());
        }

        $data = TransaksiPemesanan::with('unit','klien')->whereSlug($transaksi_slug)->first();
        
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

            $tipe_unit = Unit::find($request->id_unit);
           
            if ($tipe_unit->id_proyek_primari == null) {

              $request->merge(['status' => "secondary_unit"]);
            
            } else {
                $request->merge(['status' => "proyek_primary"]);

            }
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
            "cara_bayar" => "bail|required",
            "deskripsi_pembayaran" => "bail|nullable"
        ]);
    }
  
}
