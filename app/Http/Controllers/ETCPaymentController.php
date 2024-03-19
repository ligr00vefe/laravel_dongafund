<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ETCPaymentController extends Controller
{
    public function index()
    {
        return view("fund.etc.index");
    }
}
