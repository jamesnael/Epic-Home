<?php

namespace Modules\Transaksi\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TransaksiSecondaryUnitController extends Controller
{
    /**
     * TitipJualSewaController constructor.
     *
     */
    public function __construct()
    {
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => url('transaksi-secondary-unit.index'), 'text' => 'Transaksi'],
            ['href' => route('transaksi-secondary-unit.index'), 'text' => 'Transaksi Secondary Unit'],
        ];
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $table_headers = [
            [
                "text" => 'Tanggal Pemesanan',
                "align" => 'center',
                "sortable" => false,
                "value" => 'tanggal_pesan',
            ],
            [
                "text" => 'Jenis Bangunan',
                "align" => 'center',
                "sortable" => false,
                "value" => 'jenis_bangunan',
            ],
            [
                "text" => 'Nama Unit',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama_unit',
            ],
            [
                "text" => 'Status',
                "align" => 'center',
                "sortable" => false,
                "value" => 'status',
            ],
            [
                "text" => 'Luas Tanah',
                "align" => 'center',
                "sortable" => false,
                "value" => 'luas_tanah',
            ],
            [
                "text" => 'Luas Bangunan',
                "align" => 'center',
                "sortable" => false,
                "value" => 'luas_bangunan',
            ],
            [
                "text" => 'Klien',
                "align" => 'center',
                "sortable" => false,
                "value" => 'klien',
            ],
            [
                "text" => 'Cara Bayar',
                "align" => 'center',
                "sortable" => false,
                "value" => 'cara_bayar',
            ],
            [
                "text" => 'Sales',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama_sales',
            ]
           
        ];
        return view('transaksi::transaksi_secondary_unit.index')
            ->with('page_title', 'Transaksi Secondary Unit')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('table_headers', $table_headers);
    }

     /**
     * Show the form for editing the specified resource.
     * @param TransaksiPemesanan $transaksi_secondary_unit
     * @return Renderable
     */
    public function edit(TransaksiPemesanan $transaksi_secondary_unit)
    {
        $this->breadcrumbs[] = ['href' => route('transaksi-secondary-unit.edit', [ $transaksi_secondary_unit->slug ]), 'text' => 'Ubah Transaksi Secondary Unit ' . $transaksi_secondary_unit->unit->nama_unit ?? $transaksi_secondary_unit->unit->nomor_unit ];

        return view('transaksi::transaksi.edit')
            ->with('data', $transaksi_secondary_unit)
            ->with('page_title', 'Ubah Transaksi Secondary Unit ' . $transaksi_secondary_unit->unit->nama_unit ?? $transaksi_secondary_unit->unit->nomor_unit)
            ->with('breadcrumbs', $this->breadcrumbs);
    }
}
