<?php

namespace Modules\ManageUser\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ManageUser\Entities\User;

class SalesController extends Controller
{
    /**
     * SalesController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('sales.index'), 'text' => 'Sales Data'],
            ['href' => route('sales.index'), 'text' => 'Sales'],
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
                "text" => 'Tanggal Registrasi',
                "align" => 'center',
                "sortable" => false,
                "value" => 'tanggal_registrasi',
            ],
            [
                "text" => 'Nama Sales',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama',
            ],
            [
                "text" => 'No. Handphone',
                "align" => 'center',
                "sortable" => false,
                "value" => 'telepon',
            ],
            [
                "text" => 'No. Handphone Agen Referensi',
                "align" => 'center',
                "sortable" => false,
                "value" => 'no_telepon_agent_referensi',
            ],
            [
                "text" => 'Tipe Agent',
                "align" => 'center',
                "sortable" => false,
                "value" => 'tipe_agent',
            ],
            [
                "text" => 'Kantor Agent',
                "align" => 'center',
                "sortable" => false,
                "value" => 'kantor_agent',
            ],
            [
                "text" => 'Jenis Kelamin',
                "align" => 'center',
                "sortable" => false,
                "value" => 'jenis_kelamin',
            ],
             [
                "text" => 'Status',
                "align" => 'center',
                "sortable" => false,
                "value" => 'status_sales',
            ]
           
        ];
        return view('manageuser::sales.index')
            ->with('page_title', 'Sales')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('sales.create'), 'text' => 'Tambah Sales'];

        return view('manageuser::sales.create')
            ->with('page_title', 'Tambah Sales')
            ->with('breadcrumbs', $this->breadcrumbs);
    }



    public function edit(User $sales)
    {
        $this->breadcrumbs[] = ['href' => route('sales.edit', [ $sales->slug ]), 'text' => 'Ubah Sales ' . $sales->nama];

        return view('manageuser::sales.edit')
            ->with('data', $sales->load('sales'))
            ->with('page_title', 'Ubah Sales ' . $sales->nama)
            ->with('breadcrumbs', $this->breadcrumbs);
    }
}
