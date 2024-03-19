<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FundIntroController extends Controller
{
    public function index()
    {
        return view("fund.intro.index");
    }
}
