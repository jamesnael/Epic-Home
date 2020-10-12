<?php

namespace Modules\ManageUser\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LoginController extends Controller
{
    /**
     * UserController constructor.
     *
     */
    public function __construct()
    {
        // $this->middleware(['guest']);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function showLoginForm()
    {
        return view('manageuser::auth.login');
    }
}
