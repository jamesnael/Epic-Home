<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Http\Controllers\Helper\ProyekPrimaryHelper;

class ProyekPrimaryController extends Controller
{
    /**
     * ProyekPrimaryController constructor.
     *
     */
    public function __construct()
    {
        // $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'Master Data'],
            ['href' => route('proyek-primary.index'), 'text' => 'Proyek Primary'],
        ];

        $this->helper = new ProyekPrimaryHelper;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $table_headers = [
            [
                "text" => 'Proyek Primary',
                "align" => 'center',
                "sortable" => false,
                "value" => '',
            ],
            [
                "text" => 'Deskripsi',
                "align" => 'center',
                "sortable" => false,
                "value" => '',
            ],
            [
                "text" => 'Terakhir Diubah',
                "align" => 'center',
                "sortable" => false,
                "value" => '',
            ]
           
        ];
        return view('masterdata::proyek_primary.index')
            ->with('page_title', 'Proyek Primary')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('proyek-primary.create'), 'text' => 'Tambah Proyek Primary'];

        return view('masterdata::proyek_primary.create')
            ->with('page_title', 'Tambah Proyek Primary')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with($this->helper->getHelper());
    }

    /**
     * Show the form for editing the specified resource.
     * @param ProyekPrimary $proyek_primary
     * @return Renderable
     */
    public function edit(ProyekPrimary $proyek_primary)
    {
        $this->breadcrumbs[] = ['href' => route('proyek-primary.edit', [ $proyek_primary->slug ]), 'text' => 'Ubah Proyek Primary ' . $proyek_primary->nama_proyek_primary];

        return view('masterdata::proyek_primary.edit')
            ->with('data', $proyek_primary)
            ->with('page_title', 'Ubah Proyek Primary ' . $proyek_primary->nama_proyek_primary)
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with($this->helper->getHelper());
    }
}
