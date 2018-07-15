<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function impersonate($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('impersonate', $user);

        Auth::user()->setImpersonating($user->id);

        return redirect('/home');
    }

    public function stopImpersonate()
    {
        if (Auth::user()->can('stopImpersonate', User::class)) {
            Auth::user()->stopImpersonating();
        }

        return redirect('/home');
    }
}
