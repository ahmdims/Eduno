<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Website;

class WebsiteAppController extends Controller
{
    public function index()
    {
        $contact = Website::first();

        return view('app.contact.index', compact('contact'));
    }
}
