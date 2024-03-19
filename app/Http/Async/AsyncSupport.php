<?php


namespace App\Http\Async;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsyncSupport
{
    private $categoryMatch = [
        "campaign" => "주요 캠페인 지원",
        "student" => "학생 지원",
        "research" => "연구 지원",
        "college" => "단과대/학과 지원",
        "like" => "대학생활 지원"
    ];


    public function load(Request $request)
    {
        $category = $request->input("category");
        $page = $request->input("page") ?? 1;
        $lists = DB::table("donation_programs")
            ->where("categories", "like", "%{$this->categoryMatch[$category]}%")
            ->limit(12)
            ->offset(($page-1) * 12)
            ->orderByDesc("id")
            ->get();

        return view("support.include.more", [
            "lists" => $lists,
        ]);

    }
}
