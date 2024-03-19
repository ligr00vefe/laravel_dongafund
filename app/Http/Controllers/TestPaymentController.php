<?php

namespace App\Http\Controllers;

use App\Payments\Popbill;
use Illuminate\Http\Request;

class TestPaymentController extends Controller
{
    public function index()
    {
        return view("test.payment.index");
    }

    public function result()
    {
        return view("test.payment.result");
    }

    public function popbill()
    {
        $popbill = new Popbill();
        $popbill->check();
        return view("test.payment.popbill");
    }
}
