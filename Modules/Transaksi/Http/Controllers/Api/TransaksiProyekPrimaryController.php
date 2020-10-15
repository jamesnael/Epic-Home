<?php

namespace Modules\Transaksi\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Transaksi\Entities\TransaksiPemesanan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TransaksiProyekPrimaryController extends Controller
{
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

        $query = TransaksiPemesanan::with('unit')->where('status', 'proyek_primary')->where('jumlah_bayar', 0);

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('nama', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('deskripsi', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $item->tanggal_pesan = $item->created_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');
            $item->nama_proyek = $item->unit->proyek_primary->nama_proyek ?? '';
            $item->tipe_unit = $item->unit->tipe_unit->nama_tipe_unit ?? '';
            $item->blok = $item->unit->blok ?? '';
            $item->nomor_unit = $item->unit->nomor_unit ?? '';
            $item->harga_unit = $item->unit->harga_unit ?? 0;
            $item->nama_klien = $item->klien->nama_klien ?? '';
            $item->nama_sales = $item->unit->sales->user->nama ?? '';
            return $item;
        });

        return response_json(true, null, 'Data retrieved.', $data);
    }

    /**
     *
     * Get the resources from storage.
     * @return Renderable
     *
     */
    public function tableBayar(Request $request)
    {
        $validator = $this->validateTableRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Isian form salah', $validator->errors()->first());
        }

        $query = TransaksiPemesanan::with('unit')->where('status', 'proyek_primary')->where('jumlah_bayar', '>', 0);

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('nama', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('deskripsi', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $item->tanggal_pesan = $item->created_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');
            $item->nama_proyek = $item->unit->proyek_primary->nama_proyek ?? '';
            $item->tipe_unit = $item->unit->tipe_unit->nama_tipe_unit ?? '';
            $item->blok = $item->unit->blok ?? '';
            $item->nomor_unit = $item->unit->nomor_unit ?? '';
            $item->harga_unit = $item->unit->harga_unit ?? 0;
            $item->nama_klien = $item->klien->nama_klien ?? '';
            $item->nama_sales = $item->unit->sales->user->nama ?? '';
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
