<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Faq;

class FaqAppController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('id', 'desc')->get();
        return view('app.faq.index', compact('faqs'));
    }
}
