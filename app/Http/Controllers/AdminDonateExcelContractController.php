<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDonateExcelContractController extends Controller
{
    public function index()
    {
        return view("admin.donate.excel.contract.index", [
            "category" => false
        ]);
    }
}
