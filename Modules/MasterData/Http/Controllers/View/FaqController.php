<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Faq;
use Modules\MasterData\Http\Controllers\Helper\FaqHelper;

class FaqController extends Controller
{
    /**
     * FaqController constructor.
     *
     */
    public function __construct()
    {
        // $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'Master Data'],
            ['href' => route('faq.index'), 'text' => 'Faq'],
        ];

        $this->helper = new FaqHelper;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('masterdata::faq.index')
            ->with('breadcrumbs', $this->breadcrumbs);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('faq.create'), 'text' => 'Tambah Faq'];

        return view('masterdata::faq.create')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with($this->helper->getHelper());
    }

    /**
     * Show the form for editing the specified resource.
     * @param Faq $faq
     * @return Renderable
     */
    public function edit(Faq $faq)
    {
        $this->breadcrumbs[] = ['href' => route('faq.edit', [ $faq->slug ]), 'text' => 'Ubah Faq ' . $faq->question];

        return view('masterdata::faq.edit')
            ->with('data', $faq)
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with($this->helper->getHelper());
    }
}
