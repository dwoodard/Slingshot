<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function page($slug)
    {
        $page = Page::where('slug','=', $slug)->first();

        if (!$page){
            abort(404);
        }

        $data = [
            'page' => $page
        ];
        return Inertia::render('Page', $data);
    }

}
