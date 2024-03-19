<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailNumberController extends Controller
{
    public function index()
    {
        return view("mail.number.index");
    }
}
