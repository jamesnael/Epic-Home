<?php

namespace Modules\Transaksi\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Transaksi\Entities\TitipJualSewa;
use Modules\Transaksi\Http\Controllers\Helper\HelperTitipJualSewa;

class TitipJualSewaController extends Controller
{
    /**
     * TitipJualSewaController constructor.
     *
     */
    public function __construct()
    {
        // $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => url('titip-jual-sewa.index'), 'text' => 'Master Data'],
            ['href' => route('titip-jual-sewa.index'), 'text' => 'Titip Jual/Sewa Unit'],
        ];

        $this->helper = new HelperTitipJualSewa;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $table_headers = [
            [
                "text" => 'Tanggal Input',
                "align" => 'center',
                "sortable" => false,
                "value" => 'tanggal_input',
            ],
            [
                "text" => 'Nama Pemilik',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama_pemilik',
            ],
            [
                "text" => 'Telepon',
                "align" => 'center',
                "sortable" => false,
                "value" => 'telepone',
            ],
            [
                "text" => 'Kebutuhan',
                "align" => 'center',
                "sortable" => false,
                "value" => 'kebutuhan',
            ],
            [
                "text" => 'Tipe Bangunan',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama_tipe_bangunan',
            ],
            [
                "text" => 'Kota',
                "align" => 'center',
                "sortable" => false,
                "value" => 'kota',
            ]
           
        ];
        return view('transaksi::titip_jual_sewa.index')
            ->with('page_title', 'Titip Jual/Sewa Unit')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('titip-jual-sewa.create'), 'text' => 'Tambah Titip Jual/Sewa Unit'];

        return view('transaksi::titip_jual_sewa.create')
            ->with('page_title', 'Tambah Titip Jual/Sewa Unit')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with($this->helper->getHelper());
    }

    /**
     * Show the form for editing the specified resource.
     * @param TitipJualSewa $titip_jual_sewa
     * @return Renderable
     */
    public function edit(TitipJualSewa $titip_jual_sewa)
    {
        $this->breadcrumbs[] = ['href' => route('titip-jual-sewa.edit', [ $titip_jual_sewa->slug ]), 'text' => 'Ubah Titip Jual/Sewa Unit ' . $titip_jual_sewa->nama_pemilik];

        return view('transaksi::titip_jual_sewa.edit')
            ->with('data', $titip_jual_sewa)
            ->with('page_title', 'Ubah Titip Jual/Sewa Unit ' . $titip_jual_sewa->nama_pemilik)
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with($this->helper->getHelper());;
    }
}
