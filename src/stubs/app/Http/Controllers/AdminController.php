<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
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

    public function users(Request $request):Response
    {
        $data = [
            'users' => UserResource::collection(User::paginate(15))
        ];

        return Inertia::render('Admin/Users', $data);
    }

    public function pages(Request $request):Response
    {
        $data = [
            'pages' => UserResource::collection(User::paginate(15))
        ];

        return Inertia::render('Admin/Pages', $data);
    }
}
