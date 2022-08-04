<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function page($link)
    {
        $page = Page::where('link','=', $link)->first();

        if (!$page){
            abort(404);
        }

        $data = [
            'page' => $page
        ];
        return Inertia::render('Page', $data);
    }

}
