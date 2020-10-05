<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\TipeUnit;
use Modules\MasterData\Http\Controllers\Helper\TipeUnitHelper;

class TipeUnitController extends Controller
{
   /**
     * TipeUnitController constructor.
     *
     */
    public function __construct()
    {
        // $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'Master Data'],
            ['href' => route('tipe-unit.index'), 'text' => 'Tipe Unit'],
        ];

        $this->helper = new TipeUnitHelper;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('masterdata::tipe_unit.index')
             ->with('breadcrumbs', $this->breadcrumbs);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('tipe-unit.create'), 'text' => 'Tambah Tipe Unit'];

        return view('masterdata::tipe_unit.create')
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with($this->helper->getHelper());
    }

    /**
     * Show the form for editing the specified resource.
     * @param TipeUnit $tipe_unit
     * @return Renderable
     */
    public function edit(TipeUnit $tipe_unit)
    {
        $this->breadcrumbs[] = ['href' => route('tipe-unit.edit', [ $tipe_unit->slug ]), 'text' => 'Ubah Tipe Unit ' . $tipe_unit->nama];

        return view('masterdata::tipe_unit.edit')
             ->with('data', $tipe_unit)
             ->with('breadcrumbs', $this->breadcrumbs);
    }
}
