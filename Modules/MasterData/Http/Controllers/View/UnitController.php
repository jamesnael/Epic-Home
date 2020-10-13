<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Unit;
use Modules\MasterData\Entities\ProyekPrimary;
use Modules\MasterData\Http\Controllers\Helper\UnitHelper;

class UnitController extends Controller
{
   /**
     * UnitController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => url('/'), 'text' => 'Master Data'],
            ['href' => url('proyek-primary.index'), 'text' => 'Proyek Primary'],
        ];

        $this->helper = new UnitHelper;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ProyekPrimary $proyek_primary)
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

        $this->breadcrumbs[] = ['href' => route('proyek-primary.unit.index',[$proyek_primary->slug]), 'text' => 'Unit'];
        $this->breadcrumbs[] = ['href' => route('proyek-primary.unit.index',[$proyek_primary->slug]), 'text' => 'Unit Proyek Primary ' . $proyek_primary->nama_proyek ?? ''];
        return view('masterdata::unit.index')
            ->with('page_title', 'Unit Proyek Primary ' . $proyek_primary->nama_proyek ?? '')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('table_headers', $table_headers)
            ->with('proyek_primary', $proyek_primary);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(ProyekPrimary $proyek_primary)
    {
        $this->breadcrumbs[] = ['href' => route('proyek-primary.unit.create', [ $proyek_primary->slug ]), 'text' => 'Tambah Unit'];

        return view('masterdata::unit.create')
            ->with('page_title', 'Tambah Unit')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with($this->helper->getHelper())
            ->with('proyek_primary', $proyek_primary);
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
