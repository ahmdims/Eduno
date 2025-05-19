<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Plan;

class PlanAppController extends Controller
{
    public function index()
    {
        $subscribes = Plan::all();

        foreach ($subscribes as $subscribe) {
            $subscribe->pricing_features = is_array($subscribe->pricing_features)
                ? $subscribe->pricing_features
                : json_decode($subscribe->pricing_features, true);
        }

        return view('app.subscribe.index', compact('subscribes'));
    }
}
