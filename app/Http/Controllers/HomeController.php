<?php

namespace App\Http\Controllers;

use App\Services\PackageService;
use App\Services\SettingsService;

class HomeController extends Controller
{
    public function __invoke(PackageService $packages, SettingsService $settings)
    {
        return view('home', ['packages' => $packages->getAll(), 'settings' => $settings->get()]);
    }
}
