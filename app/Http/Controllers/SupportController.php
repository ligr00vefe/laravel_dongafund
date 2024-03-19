<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupportController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->input("category") ?? "campaign";
        $term = $request->input("term") ?? false; // 검색어

        $college = $request->input('college') ?? false;
        $major = $request->input('major') ?? false;

        $title = "주요 캠페인 지원";
        $head = false;

        $haveCollege = false;
        $haveMajor = false;

        switch ($category)
        {
            case "campaign":
                $title = "주요 캠페인 지원";
                break;
            case "student":
                $title = "학생 지원";
                break;
            case "research":
                $title = "연구 지원";
                break;
            case "college":
                $title = "단과대/학과 지원";
                $head = true;
                if(!empty($college)){$haveCollege = true;}
                if(!empty($major)){$haveMajor = true;}
                break;
            case "life":
                $title = "대학생활 지원";
                break;
            default: break;
        }

        $lists = DB::table("donation_programs as t1")
            ->where("t1.categories", "like", "%{$title}%")
            ->when($college, function($query, $college){
                return $query->where('college', $college);
            })
            ->when($major, function($query, $major){
                return $query->where('major', $major);
            })
            ->when($term, function ($query, $term) {
                return $query->where("subject", "like", "%{$term}%");
            })
            ->orderByDesc("t1.order")
            ->limit(12)
            ->get();

        return view("support.index", [
            "category" => $category,
            "title" => $title,
            "head" => $head,
            "lists" => $lists
        ]);
    }
}
