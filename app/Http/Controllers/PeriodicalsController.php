<?php

namespace App\Http\Controllers;

use App\Boards\Periodicals;
use Illuminate\Http\Request;

class PeriodicalsController extends Controller
{
    public function index(Request $request)
    {
        $periodicals = new Periodicals();
        $periodicals->setPaging(6);
        $lists = $periodicals->get($request);
        $category = $request->input("category") ?? "all";

        return view("periodicals.index", [
            "category" => $category,
            "lists" => $lists->lists
        ]);
    }

    public function create()
    {
//        return view("annual.report.create");
    }
}
