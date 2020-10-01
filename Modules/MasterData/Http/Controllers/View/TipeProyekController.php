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
        // $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'Master Data'],
            ['href' => route('tipe-proyek.index'), 'text' => 'Tipe Proyek'],
        ];
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('masterdata::tipe_proyek.index')
             ->with('breadcrumbs', $this->breadcrumbs);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('tipe-proyek.create'), 'text' => 'Tambah Tipe Proyek'];

        return view('masterdata::tipe_proyek.create')
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
             ->with('breadcrumbs', $this->breadcrumbs);
    }
}
