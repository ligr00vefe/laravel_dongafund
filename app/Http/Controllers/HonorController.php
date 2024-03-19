<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HonorController extends Controller
{
    public function index(Request $request)
    {

        $type = $request->input("loungeType") ?? "benefit";
        $type2 = $request->input("type") ?? "billion";

        return view("honor.index", [
            "type"=>$type,
            "type2"=>$type2,
        ]);
    }
}
