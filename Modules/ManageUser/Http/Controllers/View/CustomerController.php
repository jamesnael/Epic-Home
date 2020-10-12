<?php

namespace Modules\ManageUser\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ManageUser\Entities\User as Customer;

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
            ['href' => route('customer.index'), 'text' => 'Kelola User'],
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
                "text" => 'Email',
                "align" => 'center',
                "sortable" => false,
                "value" => 'email',
            ],
            [
                "text" => 'No Handphone',
                "align" => 'center',
                "sortable" => false,
                "value" => 'telepon',
            ],
            
           
        ];
        return view('manageuser::customer.index')
             ->with('page_title', 'Customer')
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Customer $customer
     * @return Renderable
     */
    public function edit(Customer $customer)
    {
        $this->breadcrumbs[] = ['href' => route('customer.edit', [ $customer->slug ]), 'text' => 'Ubah Customer ' . $customer->nama];

        return view('manageuser::customer.edit')
             ->with('data', $customer)
             ->with('page_title', 'Ubah Customer ' . $customer->nama)
             ->with('breadcrumbs', $this->breadcrumbs);
    }
}
