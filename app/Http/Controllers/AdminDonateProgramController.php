<?php

namespace App\Http\Controllers;

use App\Models\DonationProgram;
use App\Uploads\DonateAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminDonateProgramController extends Controller
{

    public function __construct(Request $request)
    {
        $category = $request->input("category") ?? "";
        $querystring = urldecode(http_build_query($request->query()));

        view()->share("category", $category);
        view()->share("querystring", $querystring);
    }

    public function index(Request $request)
    {
        $category = $request->input("category") ?? false;
        $keyword = $request->input("keyword") ?? false;
        $page = $request->input("page") ?? 1;

        $query = DB::table("donation_programs")
            ->when($category, function ($query, $category) {
                return $query->where("categories", "like", "%{$category}%");
            })
            ->when($keyword, function ($query, $keyword) {
                return $query->whereRaw("(subject like ? or contents like ?)", [ "%{$keyword}%", "%{$keyword}%"]);
            });

        $paging = $query->count();
        $lists = $query->orderByDesc("id")->paginate(15);

        return view("admin.donate.program.index", [
            "lists" => $lists,
            "paging" => $paging,
            "keyword" => $keyword,
            "page" => $page,
        ]);
    }

    public function create(Request $request)
    {
        return view("admin.donate.program.create", [
            "action" => "/b1BjW55p/donate/program"
        ]);
    }

    public function show($id)
    {
        return view("admin.donate.program.show", [
            "post" => $id
        ]);
    }

    public function edit (DonationProgram  $id)
    {
        return view("admin.donate.program.create", [
            "program" => $id,
            "edit" => 1,
            "action" => "/b1BjW55p/donate/program/{$id->id}"
        ]);
    }

    public function update(Request $request)
    {
//        dd($request->input());
        $program = DonationProgram::find($request->input("id"));
        $program->donation_code = $request->input("donation_code") ?? "";
        $program->subject = $request->input("subject");
        $program->order = $request->input("order") ?? null;
        $program->donation_type1 = $request->input("donation_type1") ?? 2;
        $program->donation_type2 = $request->input("donation_type2") ?? 2;
        $program->donation_type3 = $request->input("donation_type3") ?? 3;
        $program->payment_method = $request->input("payment_method") ?? "";
        $program->categories = $request->input("categories") ?? "";
        $program->college = $request->input("college") ?? "";
        $program->major = $request->input("major") ?? "";
        $program->fixing_check = $request->input("fixing_check") ?? "";
        $program->fixing_price = $request->input("fixing_price") ?? "";
        $program->contents = $request->input("contents") ?? "";

        if ($request->file()) {
            $attachment = new DonateAttachment;
            $attach = $attachment->set($request);

            if ($attach) {
                if (isset($attach['icon'])) {
                    $program->icon = $attach['icon'] ?? null;
                }
                if (isset($attach['thumbnail'])) {
                    $program->thumbnail = $attach['thumbnail'] ?? null;
                }
            }
        }


        if ($program->save())
        {
            return redirect("/b1BjW55p/donate/program")->with("msg", "수정했습니다");
        }
        else
        {
            return back()->with("error", "수정 중에 문제가 발생했습니다. 다시 시도해 주세요");
        }
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();


        if ($request->file()) {
            $attachment = new DonateAttachment;
            $attach = $attachment->set($request);

            if ($attach) {

                if (isset($attach['icon'])) {
                    $icon_id = $attach['icon'] ?? null;
                }
                if (isset($attach['thumbnail'])) {
                    $thumbnail = $attach['thumbnail'] ?? null;
                }

            }
        }

        $id = DB::table("donation_programs")
            ->insertGetId([
                "user_id" => $user_id ?? 1,
                "donation_code" => $request->input("donation_code") ?? "",
                "subject" => $request->input("subject"),
                "order" => $request->input("order"),
                "donation_type1" => $request->input("donation_type1") ?? 2,
                "donation_type2" => $request->input("donation_type2") ?? 2,
                "donation_type3" => $request->input("donation_type3") ?? 2,
                "payment_method" => $request->input("payment_method"),
                "categories" => $request->input("categories"),
                "college" => $request->input("college"),
                "major" => $request->input("major"),
                "fixing_check" => $request->input("fixing_check") ?? 2,
                "fixing_price" => $request->input("fixing_price") ?? "",
                "icon" => $icon_id ?? null,
                "thumbnail" => $thumbnail ?? null,
                "contents" => $request->input("contents") ?? "",
            ]);

        if ($id)
        {
            return redirect()->route("admin.donate.program.index")->with("msg", "기부 프로그램을 등록했습니다.");
        }
        else
        {
            return back()->with("error", "등록에 실패했습니다. 다시 시도해 주세요");
        }

    }

    // 선택 수정
    public function s_update(Request $request)
    {
        $ids = $request->input("id") ?? false;
        if (!$ids) return back()->with("error", "프로그램을 선택해주세요");

        $querystring = $request->input("querystring");

        $transaction = DB::transaction(function () use ($request, $ids) {

            $error = false;

            foreach ($ids as $id)
            {
                $program = DonationProgram::find($id);
                $donation_type1 = $request->input("donation_type1")[$id] ?? 2;
                $donation_type2 = $request->input("donation_type2")[$id] ?? 2;
                $donation_type3 = $request->input("donation_type3")[$id] ?? 2;

                if ($donation_type1) {
                    $program->donation_type1 = $donation_type1;
                }
                if ($donation_type2) {
                    $program->donation_type2 = $donation_type2;
                }
                if ($donation_type3) {
                    $program->donation_type3 = $donation_type3;
                }

                $error = $program->save();
                if (!$error) return $error;

            }

            return $error;

        });

        if ($transaction)
        {
            return redirect("/b1BjW55p/donate/program?{$querystring}")->with("msg", "수정했습니다");
        }
        else
        {
            return back()->with("error", "문제가 발생했습니다. 다시 시도해 주세요");
        }

    }


    public function s_destroy(Request $request)
    {
        $IDList =  $request->input("id") ?? false;
        if(!$IDList) return back()->with("error", "프로그램을 선택해 주세요");

        $queryString = $request->input("querystring") ?? "";

        $transaction = DB::transaction(function () use ($request, $IDList){

            $error = false;

            foreach($IDList as $id)
            {
                $error = DB::table('donation_programs')->delete($id);
                if(!$error)  return $error;

            }
            return $error;
        });

        if($transaction){
            return redirect("/b1BjW55p/donate/program?{$queryString}")->with("msg", "삭제되었습니다");
        } else {
            return back()->with("error", "문제가 발생 했습니다. 다시 시도해 주세요");
        }

    }




}
