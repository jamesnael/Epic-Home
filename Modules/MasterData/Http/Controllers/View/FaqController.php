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
        $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('faq.index'), 'text' => 'Master Data'],
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
        $table_headers = [
            [
                "text" => 'Menu',
                "align" => 'center',
                "sortable" => false,
                "value" => 'menu',
            ],
            [
                "text" => 'Kategori',
                "align" => 'center',
                "sortable" => false,
                "value" => 'kategori',
            ],
            [
                "text" => 'Pertanyaan',
                "align" => 'center',
                "sortable" => false,
                "value" => 'pertanyaan',
            ],
            [
                "text" => 'Publish',
                "align" => 'center',
                "sortable" => false,
                "value" => 'publish',
            ],
            [
                "text" => 'Terakhir Diubah',
                "align" => 'center',
                "sortable" => false,
                "value" => 'last_update',
            ]
           
        ];
        return view('masterdata::faq.index')
             ->with('page_title', 'Faq')
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('faq.create'), 'text' => 'Tambah Faq'];

        return view('masterdata::faq.create')
            ->with('page_title', 'Tambah Faq')
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
        $this->breadcrumbs[] = ['href' => route('faq.edit', [ $faq->slug ]), 'text' => 'Ubah Faq ' . $faq->pertanyaan];

        return view('masterdata::faq.edit')
            ->with('data', $faq)
            ->with('page_title', 'Ubah Faq ' . $faq->pertanyaan)
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with($this->helper->getHelper());
    }
}
