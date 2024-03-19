<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPrivacyInquireExcelController extends Controller
{
    public function index()
    {
        return view("admin.privacy.inquire.excel.index");
    }

}
