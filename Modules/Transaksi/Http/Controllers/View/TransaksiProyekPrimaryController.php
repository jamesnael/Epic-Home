<?php

namespace Modules\Transaksi\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Transaksi\Entities\TransaksiPemesanan;

class TransaksiProyekPrimaryController extends Controller
{
    /**
     * TitipJualSewaController constructor.
     *
     */
    public function __construct()
    {
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => url('transaksi-proyek-primary.index'), 'text' => 'Transaksi'],
            ['href' => route('transaksi-proyek-primary.index'), 'text' => 'Transaksi Proyek Primary'],
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
                "text" => 'Nama Proyek',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama_proyek',
            ],
            [
                "text" => 'Tipe Unit',
                "align" => 'center',
                "sortable" => false,
                "value" => 'tipe_unit',
            ],
            [
                "text" => 'Nomor Blok',
                "align" => 'center',
                "sortable" => false,
                "value" => 'blok',
            ],
            [
                "text" => 'Nomor Unit',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nomor_unit',
            ],
            [
                "text" => 'Harga Unit',
                "align" => 'center',
                "sortable" => false,
                "value" => 'harga_unit',
            ],
            [
                "text" => 'Klien',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama_klien',
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
        return view('transaksi::transaksi_proyek_primary.index')
            ->with('page_title', 'Transaksi Proyek Primary')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for editing the specified resource.
     * @param TransaksiPemesanan $transaksi_proyek_primary
     * @return Renderable
     */
    public function edit(TransaksiPemesanan $transaksi_proyek_primary)
    {
        $this->breadcrumbs[] = ['href' => route('transaksi-proyek-primary.edit', [ $transaksi_proyek_primary->slug ]), 'text' => 'Ubah Transaksi Proyek Primary ' . $transaksi_proyek_primary->unit->nama_unit ?? $transaksi_proyek_primary->unit->nomor_unit ];

        return view('transaksi::transaksi.edit')
            ->with('data', $transaksi_proyek_primary)
            ->with('page_title', 'Ubah Transaksi Proyek Primary ' . $transaksi_proyek_primary->unit->nama_unit ?? $transaksi_proyek_primary->unit->nomor_unit)
            ->with('breadcrumbs', $this->breadcrumbs);
    }
}
