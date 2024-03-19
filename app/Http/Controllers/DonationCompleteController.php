<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonationCompleteController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->input("id");
        $thumbnail_id = DB::table("donation_programs")
            ->where("id", $id)
            ->first()->thumbnail ?? false;

        return view("donate.complete.index", [
            "thumbnail_id" => $thumbnail_id,
            "type" => $request->input("type")
        ]);
    }
}
