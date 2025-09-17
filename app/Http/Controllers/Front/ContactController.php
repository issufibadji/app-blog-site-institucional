<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        $contact = config('institutional.contact');
        $services = config('institutional.services');

        return view('front.contact', compact('contact', 'services'));
    }
}
