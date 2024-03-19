<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FundInfoController extends Controller
{
    public function index()
    {
        return view("fund.index");
    }
}
