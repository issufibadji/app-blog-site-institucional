<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::query()->with('service:id,title')->latest()->get();
        $highlights = $galleries->take(4);

        return view('front.gallery', compact('galleries', 'highlights'));
    }
}
