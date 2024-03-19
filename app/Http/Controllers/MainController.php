<?php

namespace App\Http\Controllers;

use App\Models\BoardNotice;
use App\Models\DonationProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class MainController extends Controller
{
    public function index()
    {
        $notice = BoardNotice::where("category", "=", "기부소식")
            ->orderByDesc("id")
            ->first() ?? false;

        $notice_id = $notice->id ?? false;

        $programs = DonationProgram::orderByDesc("order", "id")->limit(3)->get();

        $tidings = BoardNotice::when($notice_id, function ($query, $notice) {
                return $query->where("id", "!=", $notice);
            })
            ->orderByDesc("id")
            ->limit(2)
            ->get();

        return view("index", [
            "notice" => $notice ?? [],
            "programs" => $programs ?? [],
            "tidings" => $tidings ?? [],
        ]);
    }
}
