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
        // $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'Master Data'],
            ['href' => route('tipe-bangunan.index'), 'text' => 'Tipe Bangunan'],
        ];
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('masterdata::tipe_bangunan.index')
             ->with('breadcrumbs', $this->breadcrumbs);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('tipe-bangunan.create'), 'text' => 'Tambah Tipe Bangunan'];

        return view('masterdata::tipe_bangunan.create')
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
             ->with('breadcrumbs', $this->breadcrumbs);
    }
}
