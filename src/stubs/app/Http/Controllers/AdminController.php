<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Menu;
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

        return Inertia::render('Admin/Pages', $data);
    }

    public function pages(Request $request):Response
    {
        $data = [
            'pages' => Page::all()
        ];

        return Inertia::render('Admin/Pages', $data);
    }
    public function pagesEdit(Request $request, $id):Response
    {

        $data = [
            'page' => Page::find($id)
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
    public function pagesSave($id, Request $request): \Illuminate\Http\RedirectResponse
    {
        unset($request['_token']);

        $page = Page::find($id)->update([
            'id' => $request->id,
            'title' => $request->title,
            'slug' => $request->slug,
            'source' => json_encode($request->get('content')),
            'middleware' => $request->middleware,
            'sort_order' => $request->sort_order,
            'is_active' => $request->is_active,
            'is_published' => $request->is_published,
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

    //menu
    public function menus(Request $request):Response
    {
        $data = [
            'menus' => \App\Models\Menu::all(),
            'pages' => Page::all("id", "title", "slug")
        ];

        return Inertia::render('Admin/Menus', $data);
    }

    public function menusCreate(Request $request)
    {
        $data = [
            'menu' => Menu::create(
                $request->validate([
                    'title' => ['required'],
                    'slug' => ['required']
                ])
            )
        ];
        return Redirect::back()->with($data);
    }

    public function menusSave($id, Request $request): \Illuminate\Http\RedirectResponse
    {
        $menu = Menu::where('id', $id)->update(
            $request->validate([
                'title' => ['required'],
                'items' => ['required'],
                'location' => ['required']
            ])
        );

        $data = [
            'menu' => $menu
        ];

        return Redirect::back()->with($data);
    }



    //SEO
    public function seo(Request $request):Response
    {
        $data = [];

        return Inertia::render('Admin/Seo', $data);
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
