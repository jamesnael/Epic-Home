<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\AgentProperty;

class AgentPropertyController extends Controller
{
     /**
     * AgentPropertyController constructor.
     *
     */
    public function __construct()
    {
        // $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => url('agent-property.index'), 'text' => 'Master Data'],
            ['href' => route('agent-property.index'), 'text' => 'Agent Property'],
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
                "text" => 'Agent Property',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama_agent_property',
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
        return view('masterdata::agent_property.index')
            ->with('page_title', 'Agent Property')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('agent-property.create'), 'text' => 'Tambah Agent Property'];

        return view('masterdata::agent_property.create')
            ->with('page_title', 'Tambah Agent Property')
            ->with('breadcrumbs', $this->breadcrumbs);
    }

    /**
     * Show the form for editing the specified resource.
     * @param AgentProperty $agent_property
     * @return Renderable
     */
    public function edit(AgentProperty $agent_property)
    {
        $this->breadcrumbs[] = ['href' => route('agent-property.edit', [ $agent_property->slug ]), 'text' => 'Ubah Agent Property ' . $agent_property->nama_agent_property];

        return view('masterdata::agent_property.edit')
            ->with('data', $agent_property)
            ->with('page_title', 'Ubah Agent Property ' . $agent_property->nama_agent_property)
            ->with('breadcrumbs', $this->breadcrumbs);
    }
}
