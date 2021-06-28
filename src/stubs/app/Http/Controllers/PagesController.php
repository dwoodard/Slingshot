<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class PagesController extends Controller
{
    public function dashboard(): Response
    {
        /**
         * @get('/dashboard')
         * @name('dashboard')
         * @middlewares(web, auth:sanctum)
         */

        $data = [
            'foo'=>'bar'
        ];

        return Inertia::render('Dashboard', $data);
    }
}
