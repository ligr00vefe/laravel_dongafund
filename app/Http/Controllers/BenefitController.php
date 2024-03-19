<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BenefitController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->input("loungeType") ?? "benefit";

        return view("benefit.index",[
            "type"=>$type
        ]);
    }
}
