<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Cluster;

class ClusterController extends Controller
{
    /**
     * ClusterController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => url('cluster.index'), 'text' => 'Master Data'],
            ['href' => route('cluster.index'), 'text' => 'Cluster'],
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
                "text" => 'Cluster',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama_cluster',
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
        return view('masterdata::cluster.index')
            ->with('page_title', 'Cluster')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('cluster.create'), 'text' => 'Tambah Cluster'];

        return view('masterdata::cluster.create')
            ->with('page_title', 'Tambah Cluster')
            ->with('breadcrumbs', $this->breadcrumbs);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Cluster $cluster
     * @return Renderable
     */
    public function edit(Cluster $cluster)
    {
        $this->breadcrumbs[] = ['href' => route('cluster.edit', [ $cluster->slug ]), 'text' => 'Ubah Cluster ' . $cluster->nama_cluster];

        return view('masterdata::cluster.edit')
            ->with('data', $cluster)
            ->with('page_title', 'Ubah Cluster ' . $cluster->nama_cluster)
            ->with('breadcrumbs', $this->breadcrumbs);
    }
}
