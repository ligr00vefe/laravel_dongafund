<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailAddressChangeController extends Controller
{
    public function index()
    {
        return view("mail.address.index");
    }
}
