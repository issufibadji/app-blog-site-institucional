<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        $services = config('institutional.services');

        return view('front.services', compact('services'));
    }
}
