<?php

namespace App\Http\Controllers;

use App\Models\BoardNotice;
use App\Models\DonationProgram;
use Illuminate\Http\Request;
use App\Boards\Notice;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $notice = new Notice();

        $lists = $notice->get($request);

        $loungeType = $request->input("loungeType") ?? "news";
        $category = $request->input("category") ?? "";

        return view("news.index", [
            "loungeType" => $loungeType,
            "category" => $category,
            "lists" => $lists->lists,
        ]);
    }

    public function create()
    {
        return view("news.create");
    }

    public function show($id)
    {
        $post = BoardNotice::find($id);
        $programs = DonationProgram::orderByDesc("order", "created_at")->limit(4)->get();

        return view("news.show", [
            "post" => $post ?? false,
            "programs" => $programs ?? []
        ]);
    }
}
