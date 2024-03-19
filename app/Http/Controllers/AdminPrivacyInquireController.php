<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPrivacyInquireController extends Controller
{

    public function __construct(Request $request)
    {
        $category = $request->input("category") ?? "all";
        view()->share("category", $category);
    }

    public function index(Request $request)
    {
        $from_date = $request->input("from_date");
        $to_date = $request->input("to_date");
        $keyword = $request->input("keyword");

        $lists = DB::table("view_privacy_inquire")
            ->when($keyword, function ($query, $keyword) {
                return $query->where("name", "like", "%{$keyword}%");
            })
            ->when($from_date, function ($query, $from_date) {
                return $query->where("created_at", ">=", $from_date);
            })
            ->when($to_date, function ($query, $to_date) {
                return $query->where("created_at", "<", date("Y-m-d", strtotime($to_date . "+1 days")));
            })
            ->orderByDesc("created_at")
            ->paginate();

        return view("admin.privacy.inquire.index", [
            "lists" => $lists
        ]);
    }

    public function show($id)
    {
        return view("admin.privacy.inquire.show", [
            "post" => $id
        ]);
    }
}
