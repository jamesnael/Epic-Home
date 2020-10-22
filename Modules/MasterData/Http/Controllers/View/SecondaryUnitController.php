<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Unit as SecondaryUnit;
use Modules\MasterData\Http\Controllers\Helper\SecondaryUnitHelper;

class SecondaryUnitController extends Controller
{
     
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('secondary-unit.index'), 'text' => 'Master Data'],
            ['href' => route('secondary-unit.index'), 'text' => 'Secondary Unit'],
        ];

        $this->helper = new SecondaryUnitHelper;
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
                "text" => 'Jenis Bangunan',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama_tipe_bangunan',
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
                "value" => 'status_unit',
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
                "text" => 'Sertifikat',
                "align" => 'center',
                "sortable" => false,
                "value" => 'sertifikat',
            ],
            [
                "text" => 'Harga Unit',
                "align" => 'center',
                "sortable" => false,
                "value" => 'harga_unit',
            ],
            [
                "text" => 'Sales',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama_sales',
            ],
            [
                "text" => 'Agensi',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama_kantor_agen',
            ],
            [
                "text" => 'Nama Pemilik',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama_pemilik',
            ],
             [
                "text" => 'Status',
                "align" => 'center',
                "sortable" => false,
                "value" => 'approved_status',
            ]
           
        ];
        return view('masterdata::secondary_unit.index')
            ->with('page_title', 'Secondary Unit')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('secondary-unit.create'), 'text' => 'Tambah Secondary Unit'];

        return view('masterdata::secondary_unit.create')
            ->with('page_title', 'Tambah Secondary Unit')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with($this->helper->getHelper());


    }



    public function edit(SecondaryUnit $secondary_unit)
    {
        $this->breadcrumbs[] = ['href' => route('secondary-unit.edit', [ $secondary_unit->id ]), 'text' => 'Ubah Secondary Unit ' . $secondary_unit->nama_unit];

        return view('masterdata::secondary_unit.edit')
            ->with('data', $secondary_unit)
            ->with('page_title', 'Ubah Secondary Unit ' . $secondary_unit->nama_unit)
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with($this->helper->getHelper());
    }
}
