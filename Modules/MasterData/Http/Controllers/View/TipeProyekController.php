<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\TipeProyek;

class TipeProyekController extends Controller
{
    /**
     * TipeProyekController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('tipe-proyek.index'), 'text' => 'Master Data'],
            ['href' => route('tipe-proyek.index'), 'text' => 'Tipe Proyek'],
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
                "text" => 'Tipe Proyek',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama',
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
        return view('masterdata::tipe_proyek.index')
             ->with('page_title', 'Tipe Proyek')
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('tipe-proyek.create'), 'text' => 'Tambah Tipe Proyek'];

        return view('masterdata::tipe_proyek.create')
             ->with('page_title', 'Tambah Tipe Proyek')
             ->with('breadcrumbs', $this->breadcrumbs);
    }

    /**
     * Show the form for editing the specified resource.
     * @param TipeProyek $tipe_proyek
     * @return Renderable
     */
    public function edit(TipeProyek $tipe_proyek)
    {
        $this->breadcrumbs[] = ['href' => route('tipe-proyek.edit', [ $tipe_proyek->slug ]), 'text' => 'Ubah Tipe Proyek ' . $tipe_proyek->nama];

        return view('masterdata::tipe_proyek.edit')
             ->with('data', $tipe_proyek)
             ->with('page_title', 'Ubah Tipe Proyek ' . $tipe_proyek->nama)
             ->with('breadcrumbs', $this->breadcrumbs);
    }
}
