<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function page($slug)
    {
        $data = ['slug' => $slug];
        return Inertia::render('Page', $data);
    }

    public function welcome(): Response
    {
        $data = [
            'laravelVersion' => \Illuminate\Foundation\Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ];

        return Inertia::render('Welcome', $data);
    }

    public function dashboard(): Response
    {
        $data = [];
        return Inertia::render('Dashboard', $data);
    }

    public function termsOfService(): Response
    {
        $data = [];
        return Inertia::render('TermsOfService', $data);
    }

    public function privacyPolicy(): Response
    {
        $data = [];
        return Inertia::render('PrivacyPolicy', $data);
    }

    public function profile(): Response
    {
        $data = [];
        return Inertia::render('profile/Show', $data);
    }

    public function settings(): Response
    {
        $data = [];
        return Inertia::render('settings', $data);
    }
}
