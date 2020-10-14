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
            ['href' => url('titip-jual-sewa.index'), 'text' => 'Transaksi'],
            ['href' => route('titip-jual-sewa.index'), 'text' => 'Transaksi Proyek Primary'],
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
                "value" => '',
            ],
            [
                "text" => 'Tipe Unit',
                "align" => 'center',
                "sortable" => false,
                "value" => 'telepone',
            ],
            [
                "text" => 'Nomor Blok',
                "align" => 'center',
                "sortable" => false,
                "value" => '',
            ],
            [
                "text" => 'Nomor Unit',
                "align" => 'center',
                "sortable" => false,
                "value" => '',
            ],
            [
                "text" => 'Harga Unit',
                "align" => 'center',
                "sortable" => false,
                "value" => '',
            ],
            [
                "text" => 'Klien',
                "align" => 'center',
                "sortable" => false,
                "value" => '',
            ],
            [
                "text" => 'Cara Bayar',
                "align" => 'center',
                "sortable" => false,
                "value" => '',
            ],
            [
                "text" => 'Sales',
                "align" => 'center',
                "sortable" => false,
                "value" => '',
            ]
           
        ];
        return view('transaksi::transaksi_secondary_unit.index')
            ->with('page_title', 'Transaksi Secondary Unit')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('table_headers', $table_headers);
    }
}
