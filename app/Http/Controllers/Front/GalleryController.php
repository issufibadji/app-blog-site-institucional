<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function index()
    {
        $images = config('institutional.gallery');

        return view('front.gallery', compact('images'));
    }
}
