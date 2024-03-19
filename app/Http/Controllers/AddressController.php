<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        return view("address.index");
    }

    public function show($id)
    {
        return view("address.show", [
            "id" => $id
        ]);
    }
}
