<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Boards\Periodicals;

class AnnualController extends Controller
{
    public function index(Request $request)
    {
        $periodicals = new Periodicals();
        $periodicals->setPaging(6);
        $lists = $periodicals->get($request);

        $category = $request->input("category") ?? "all";

        return view("annual.report.index", [
            "category" => $category,
            "lists" => $lists->lists
        ]);
    }

    public function create()
    {
        return view("annual.report.create");
    }
}
