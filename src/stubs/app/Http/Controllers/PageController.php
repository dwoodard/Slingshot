<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function page($slug)
    {
        $data = [
            'page' => Page::where('slug','=', $slug)->first()
        ];
        return Inertia::render('Page', $data);
    }

}
