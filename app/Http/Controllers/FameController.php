<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FameController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->input("loungeType") ?? "fame";

        return view("fame.index", [
            "type" => $type
        ]);
    }

    public function create()
    {
        return view("fame.create");
    }

    public function show($id)
    {
        return view("fame.show", [
            "id" => $id
        ]);
    }
}
