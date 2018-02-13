<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        if (Auth::user()->isAdmin()) {
            return redirect(route('admin::index'));
        }

        return view('dashboard.index');
    }
}
