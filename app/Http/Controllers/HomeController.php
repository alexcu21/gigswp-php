<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $listings = Listing::query()
            ->latest('id')
            ->limit(6)
            ->get();

        return view('home', compact('listings'));
    }
}
