<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDonateSendingContractController extends Controller
{
    public function index()
    {
        return view("admin.donate.sending.contract.index", [
            "category" => false
        ]);
    }
}
