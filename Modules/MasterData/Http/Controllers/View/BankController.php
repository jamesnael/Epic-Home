<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Bank;
use Modules\MasterData\Http\Controllers\Helper\BankHelper;

class BankController extends Controller
{
    /**
     * BankController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('bank.index'), 'text' => 'Master Data'],
            ['href' => route('bank.index'), 'text' => 'Bank'],
        ];
        $this->helper = new BankHelper;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $table_headers = [
            [
                "text" => 'Jenis Bank',
                "align" => 'center',
                "sortable" => false,
                "value" => 'jenis_bank',
            ],
            [
                "text" => 'Nama Bank',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama_bank',
            ],
            [
                "text" => 'Nama Pinjaman',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama_pinjaman',
            ],
            [
                "text" => 'Suku Bunga',
                "align" => 'center',
                "sortable" => false,
                "value" => 'suku_bunga',
            ],
            [
                "text" => 'Masa Kredit Fix',
                "align" => 'center',
                "sortable" => false,
                "value" => 'masa_kredit',
            ],
            [
                "text" => 'Tenor',
                "align" => 'center',
                "sortable" => false,
                "value" => 'tenor',
            ],
            [
                "text" => 'Status',
                "align" => 'center',
                "sortable" => false,
                "value" => 'status',
            ]
           
        ];
        return view('masterdata::bank.index')
            ->with('page_title', 'Bank')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('bank.create'), 'text' => 'Tambah Bank'];

        return view('masterdata::bank.create')
            ->with('page_title', 'Tambah Bank')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with($this->helper->getHelper());
    }

    /**
     * Show the form for editing the specified resource.
     * @param Bank $bank
     * @return Renderable
     */
    public function edit(Bank $bank)
    {
        $this->breadcrumbs[] = ['href' => route('bank.edit', [ $bank->slug ]), 'text' => 'Ubah Bank ' . $bank->nama_bank];

        return view('masterdata::bank.edit')
            ->with('data', $bank)
            ->with('page_title', 'Ubah Bank ' . $bank->nama_bank)
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with($this->helper->getHelper());
    }
}
