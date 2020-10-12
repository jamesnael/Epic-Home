<?php

namespace Modules\ManageUser\Http\Controllers\Auth;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyController extends Controller
{
    /**
     * UserController constructor.
     *
     */
    public function __construct()
    {
        // $this->middleware(['auth']);
    }

    /**
     * Show the specified resource.
     * @param \Illuminate\Http\Request $request
     * @return Renderable
     */
    public function notice(Request $request)
    {
        if (! $request->expectsJson()) {
            return view('manageuser::auth.email.verify');
        }
    }

    /**
     * Show the specified resource.
     * @param \Illuminate\Foundation\Auth\EmailVerificationRequest $request
     * @return Renderable
     */
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return url('/');
    }

    /**
     * Resend email verification for user.
     * @param \Illuminate\Foundation\Auth\EmailVerificationRequest $request
     * @return Renderable
     */
    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
