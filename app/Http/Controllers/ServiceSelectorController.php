<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceSelectorController extends Controller
{
    public function index()
    {
        return view("service.selector.index");
    }
}
