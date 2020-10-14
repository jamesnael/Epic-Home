<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\TipeBangunan;

class TipeBangunanController extends Controller
{
    /**
     * TipeBangunanController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => url('tipe-bangunan.index'), 'text' => 'Master Data'],
            ['href' => route('tipe-bangunan.index'), 'text' => 'Tipe Bangunan'],
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
                "text" => 'Tipe Bangunan',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama_tipe_bangunan',
            ],
            [
                "text" => 'Deskripsi',
                "align" => 'center',
                "sortable" => false,
                "value" => 'deskripsi',
            ],
            [
                "text" => 'Terakhir Diubah',
                "align" => 'center',
                "sortable" => false,
                "value" => 'last_update',
            ]
           
        ];
        return view('masterdata::tipe_bangunan.index')
            ->with('page_title', 'Tipe Bangunan')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('tipe-bangunan.create'), 'text' => 'Tambah Tipe Bangunan'];

        return view('masterdata::tipe_bangunan.create')
            ->with('page_title', 'Tambah Tipe Bangunan')
            ->with('breadcrumbs', $this->breadcrumbs);
    }

    /**
     * Show the form for editing the specified resource.
     * @param TipeBangunan $tipe_bangunan
     * @return Renderable
     */
    public function edit(TipeBangunan $tipe_bangunan)
    {
        $this->breadcrumbs[] = ['href' => route('tipe-bangunan.edit', [ $tipe_bangunan->slug ]), 'text' => 'Ubah Tipe Bangunan ' . $tipe_bangunan->nama_tipe_bangunan];

        return view('masterdata::tipe_bangunan.edit')
            ->with('data', $tipe_bangunan)
            ->with('page_title', 'Ubah Tipe Bangunan ' . $tipe_bangunan->nama_tipe_bangunan)
            ->with('breadcrumbs', $this->breadcrumbs);
    }
}
