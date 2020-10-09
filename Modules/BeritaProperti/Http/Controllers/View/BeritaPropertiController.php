<?php

namespace Modules\BeritaProperti\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BeritaProperti\Entities\BeritaProperti;
use Modules\BeritaProperti\Http\Controllers\Helper\BeritaPropertiHelper;

class BeritaPropertiController extends Controller
{
    /**
     * BeritaPropertiController constructor.
     *
     */
    public function __construct()
    {
        // $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('berita-properti.index'), 'text' => 'Berita Properti'],
        ];

        $this->helper = new BeritaPropertiHelper;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $table_headers = [
            [
                "text" => 'Judul',
                "align" => 'center',
                "sortable" => false,
                "value" => 'judul',
            ],
            [
                "text" => 'Thumbnail',
                "align" => 'center',
                "sortable" => false,
                "value" => 'thumbnail',
            ],
            [
                "text" => 'Penulis',
                "align" => 'center',
                "sortable" => false,
                "value" => 'penulis',
            ],
            [
                "text" => 'Publish',
                "align" => 'center',
                "sortable" => false,
                "value" => 'publish',
            ],
            [
                "text" => 'Tanggal Publish',
                "align" => 'center',
                "sortable" => false,
                "value" => 'publish_date',
            ],
            [
                "text" => 'Terakhir Diubah',
                "align" => 'center',
                "sortable" => false,
                "value" => 'last_update',
            ]
           
        ];
        return view('beritaproperti::berita_properti.index')
             ->with('page_title', 'Berita Properti')
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('berita-properti.create'), 'text' => 'Tambah Berita Properti'];

        return view('beritaproperti::berita_properti.create')
             ->with('page_title', 'Tambah Berita Properti')
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with($this->helper->getHelper());
    }

    /**
     * Show the form for editing the specified resource.
     * @param BeritaProperti $berita_properti
     * @return Renderable
     */
    public function edit(BeritaProperti $berita_properti)
    {
        $this->breadcrumbs[] = ['href' => route('berita-properti.edit', [ $berita_properti->slug ]), 'text' => 'Ubah Berita Properti ' . $berita_properti->judul];

        return view('beritaproperti::berita_properti.edit')
             ->with('data', $berita_properti)
             ->with('page_title', 'Ubah Berita Properti ' . $berita_properti->judul)
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with($this->helper->getHelper());
    }
}
