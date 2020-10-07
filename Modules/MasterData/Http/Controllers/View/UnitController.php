<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Unit;
use Modules\MasterData\Http\Controllers\Helper\UnitHelper;

class UnitController extends Controller
{
   /**
     * UnitController constructor.
     *
     */
    public function __construct()
    {
        // $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => url('/'), 'text' => 'Master Data'],
            ['href' => route('unit.index'), 'text' => 'Unit'],
        ];

        $this->helper = new UnitHelper;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $table_headers = [
            [
                "text" => 'Nama Protek',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama_proyek',
            ],
            [
                "text" => 'Tipe Unit',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama_tipe_unit',
            ],
            [
                "text" => 'No.Blok',
                "align" => 'center',
                "sortable" => false,
                "value" => 'blok',
            ],
            [
                "text" => 'No.Unit',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nomor_unit',
            ],
            [
                "text" => 'Luas Tanah',
                "align" => 'center',
                "sortable" => false,
                "value" => 'luas_tanah',
            ],
            [
                "text" => 'Harga Unit',
                "align" => 'center',
                "sortable" => false,
                "value" => 'harga_unit',
            ],
            [
                "text" => 'Terakhir Diubah',
                "align" => 'center',
                "sortable" => false,
                "value" => 'last_update',
            ]
           
        ];
        return view('masterdata::unit.index')
            ->with('page_title', 'Unit')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('unit.create'), 'text' => 'Tambah Unit'];

        return view('masterdata::unit.create')
            ->with('page_title', 'Tambah Unit')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with($this->helper->getHelper());
    }

    /**
     * Show the form for editing the specified resource.
     * @param Unit $unit
     * @return Renderable
     */
    public function edit(Unit $unit)
    {
        $this->breadcrumbs[] = ['href' => route('unit.edit', [ $unit->id ]), 'text' => 'Ubah Unit ' . $unit->nama];

        return view('masterdata::unit.edit')
            ->with('data', $unit)
            ->with('page_title', 'Ubah Unit ' . $unit->nama_tipe_unit)
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with($this->helper->getHelper());
    }
}
