<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ManageUser\Entities\User;

class CustomerController extends Controller
{
    /**
     * UserController constructor.
     *
     */
    public function __construct()
    {
        // $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('customer.index'), 'text' => 'Kelola Customer'],
            ['href' => route('customer.index'), 'text' => 'Customer'],
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
                "text" => 'Nama Customer',
                "align" => 'center',
                "sortable" => false,
                "value" => 'nama',
            ],
            [
                "text" => 'No Handphone',
                "align" => 'center',
                "sortable" => false,
                "value" => 'telepon',
            ],
            [
                "text" => 'Email',
                "align" => 'center',
                "sortable" => false,
                "value" => 'email',
            ]
            
           
        ];
        return view('masterdata::customer.index')
             ->with('page_title', 'Customer')
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    // public function create()
    // {
    //     $this->breadcrumbs[] = ['href' => route('customer.create'), 'text' => 'Tambah Customer'];

    //     return view('masterdata::customer.create')
    //          ->with('page_title', 'Tambah Customer')
    //          ->with('breadcrumbs', $this->breadcrumbs);
    // }

    /**
     * Show the form for editing the specified resource.
     * @param User $user
     * @return Renderable
     */
    public function edit(User $user)
    {
        $this->breadcrumbs[] = ['href' => route('customer.edit', [ $user->slug ]), 'text' => 'Ubah Customer ' . $user->nama];

        return view('masterdata::customer.edit')
             ->with('data', $user)
             ->with('page_title', 'Ubah Customer ' . $user->nama)
             ->with('breadcrumbs', $this->breadcrumbs);
    }
}
