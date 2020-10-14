<?php

namespace Modules\Transaksi\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Transaksi\Entities\TransaksiPemesanan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TransaksiPemesananController extends Controller
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
            $data = TransaksiPemesanan::create($request->all());

            if ($request->id_proyek_primary) {
                $data->status = 'proyek_primary';
            } else {
                $data->status = 'secondary_unit';
            }

            $data->save();

            DB::commit();
            return response_json(true, null, 'Transaksi pemesanan unit berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param TransaksiPemesanan $transaksi_pemesanan
     * @return Renderable
     */
    public function update(Request $request, TransaksiPemesanan $transaksi_pemesanan)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $transaksi_pemesanan->update($request->all());

            DB::commit();
            return response_json(true, null, 'Transaksi pemesanan unit berhasil disimpan.', $transaksi_pemesanan);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'id_klien' => 'bail|required|exists:Modules\Transaksi\Entities\Klien,id',
            'id_unit' => 'bail|required|exists:Modules\MasterData\Entities\Unit,id',
            'perihal_pembayaran' => 'bail|required|max:255',
            'jumlah_bayar' => 'bail|required|numeric',
            'terbilang' => 'bail|required',
            'keterangan' => 'bail|required',
        ]);
    }

    /**
     * Get the specified resource from storage.
     * @param TransaksiPemesanan $transaksi_pemesanan
     * @return Renderable
     */
    public function data(TransaksiPemesanan $transaksi_pemesanan)
    {
        $transaksi_pemesanan->load('klien', 'unit', 'unit.sales.user', 'unit.tipe_unit', 'unit.proyek_primary');
        return response_json(true, null, 'Data retrieved', $transaksi_pemesanan);
    }

}
