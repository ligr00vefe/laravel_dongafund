<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FundTypeController extends Controller
{
    public function index()
    {
        return view("fund.type.index");
    }
}
