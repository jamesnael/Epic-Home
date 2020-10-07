<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Developer;

class DeveloperController extends Controller
{
     
    public function __construct()
    {
        // $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'Master Data'],
            ['href' => route('developer.index'), 'text' => 'Developer'],
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
                "text" => 'Nama Developer',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama_developer',
            ],
            [
                "text" => 'Email',
                "align" => 'center',
                "sortable" => false,
                "value" => 'email',
            ],
            [
                "text" => 'No. Telepon',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nomor_telepon',
            ],
            [
                "text" => 'Alamat',
                "align" => 'center',
                "sortable" => false,
                "value" => 'alamat',
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
        return view('masterdata::developer.index')
            ->with('page_title', 'Developer')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('developer.create'), 'text' => 'Tambah Developer'];

        return view('masterdata::developer.create')
            ->with('page_title', 'Tambah Developer')
            ->with('breadcrumbs', $this->breadcrumbs);
    }



    public function edit(Developer $developer)
    {
        $this->breadcrumbs[] = ['href' => route('developer.edit', [ $developer->slug ]), 'text' => 'Ubah Developer ' . $developer->nama_developer];

        return view('masterdata::developer.edit')
            ->with('data', $developer)
            ->with('page_title', 'Ubah Developer ' . $developer->nama_developer)
            ->with('breadcrumbs', $this->breadcrumbs);
    }
}
