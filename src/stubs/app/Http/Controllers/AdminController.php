<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends \Inertia\Controller
{
    public function index()
    {
        return Redirect::route('admin.dashboard');
    }
    public function dashboard(Request $request):Response
    {
        $data = [];

        return Inertia::render('Admin/Dashboard', $data);
    }
}
