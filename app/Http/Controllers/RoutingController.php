<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RoutingController extends Controller
{

    public function index(Request $request)
    {
        return view('dashboards/index');
    }

    public function root(Request $request, $first)
    {
        return view($first);
    }

    public function secondLevel(Request $request, $first, $second)
    {
        return view($first . '.' . $second);
    }

    public function thirdLevel(Request $request, $first, $second, $third)
    {
        return view($first . '.' . $second . '.' . $third);
    }
}
