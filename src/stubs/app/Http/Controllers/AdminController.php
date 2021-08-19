<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
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
    public function usersEdit(User $user):Response
    {
        $data = [
            'user' => UserResource::make($user)
        ];

        return Inertia::render('Admin/Users/edit', $data);
    }
    public function usersCreate(Request $request): \Illuminate\Http\RedirectResponse
    {

        $request->validate([
            'email' => 'required|unique:users|email',
            'username' => 'required|min:3',
            'password' => 'required|min:8'
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return Redirect::back();
    }
    public function usersSave(Request $request): \Illuminate\Http\RedirectResponse
    {

        $request->validate([
            'email' => ['required','email', Rule::unique('users')->ignore($request->id)],
            'username' => 'required|min:3',
        ]);

        User::find($request->id)->update( $request->all());

        return Redirect::back();
    }
    public function usersDelete(Request $request, User $user): \Illuminate\Http\RedirectResponse
    {
        $user->where('email', $request->email)->delete();
        return Redirect::back();
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
    public function pagesCreate(Request $request)
    {

        $data = [
            'page' => Page::create(
                $request->validate([
                    'title' => ['required'],
                    'slug' => ['required']
                ])
            )
        ];
        return Redirect::back()->with($data);
    }
    public function pagesSave($slug, Request $request): \Illuminate\Http\RedirectResponse
    {
        unset($request['_token']);

        $page = Page::where('slug', $slug)->update([
            'source' => json_encode($request->all())
        ]);
        $data = [
            'page' => $page
        ];
        return Redirect::back()->with($data);
    }
    public function pagesDelete(Request $request): \Illuminate\Http\RedirectResponse
    {
        $page = Page::where('slug', $request->slug)->delete();
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
