<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SponsorController extends Controller
{
    public function index()
    {
        return view("sponsor.index");
    }

    public function show($id)
    {
        return view("sponsor.show", [
            "id" => $id
        ]);
    }
}
