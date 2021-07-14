<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Page;
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
            'pages' => Page::all()
        ];

        return Inertia::render('Admin/Pages', $data);
    }
    public function pagesEdit(Request $request, $slug):Response
    {
        $data = [
            'page' => Page::where('slug', '=', $slug)->first()
        ];

        return Inertia::render('Admin/Pages/edit', $data);
    }
    public function pagesSave(Request $request): \Illuminate\Http\RedirectResponse
    {

        $page = Page::where('slug', $request->slug)
            ->update($request->all());

        $data = [
            'page' => $page
        ];
        return Redirect::back()->with($data);
    }

    public function posts(Request $request):Response
    {
        $data = [
            'posts' => []
        ];

        return Inertia::render('Admin/Posts', $data);
    }

    public function settings(Request $request):Response
    {
        $data = [
            'settings' => []
        ];

        return Inertia::render('Admin/Settings', $data);
    }
}
