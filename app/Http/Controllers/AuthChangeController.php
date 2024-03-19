<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthChangeController extends Controller
{
    public function index()
    {
        return view("auth.change.index");
    }
}
