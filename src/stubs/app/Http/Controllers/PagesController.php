<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class PagesController extends Controller
{
    public function welcome(): Response
    {
        /**
         * @get('/welcome')
         * @name('welcome')
         * @middlewares(web, auth:sanctum)
         */

        $data = [
            'laravelVersion' => \Illuminate\Foundation\Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ];

        return Inertia::render('Welcome', $data);
    }

    public function dashboard(): Response
    {
        /**
         * @get('/dashboard')
         * @name('dashboard')
         * @middlewares(web, auth:sanctum)
         */

        $data = [];

        return Inertia::render('Dashboard', $data);
    }

    public function termsOfService(): Response
    {
        /**
         * @get('/dashboard')
         * @name('dashboard')
         * @middlewares(web, auth:sanctum)
         */

        $data = [];

        return Inertia::render('TermsOfService', $data);
    }

    public function privacyPolicy(): Response
    {
        /**
         * @get('/dashboard')
         * @name('dashboard')
         * @middlewares(web, auth:sanctum)
         */

        $data = [];

        return Inertia::render('PrivacyPolicy', $data);
    }

    public function profile(): Response
    {
        /**
         * @get('/dashboard')
         * @name('dashboard')
         * @middlewares(web, auth:sanctum)
         */

        $data = [];

        return Inertia::render('Profile/Show', $data);
    }

    public function settings(): Response
    {
        /**
         * @get('/dashboard')
         * @name('dashboard')
         * @middlewares(web, auth:sanctum)
         */

        $data = [];

        return Inertia::render('Settings', $data);
    }
}
