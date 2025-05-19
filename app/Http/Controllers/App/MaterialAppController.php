<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Material;

class MaterialAppController extends Controller
{
    public function index()
    {
        $materials = Material::with('course')->get();
        return view('materials.index', compact('materials'));
    }
}
