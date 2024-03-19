<?php

namespace App\Http\Controllers;

use App\Boards\Notice;
use App\Models\BoardNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminNewsManagementController extends Controller
{
    protected Notice $board;

    public function __construct(Request $request)
    {
        $this->board = new Notice();
        $category = $request->input("category") ?? "";
        view()->share("category", $category);
    }

    public function index(Request $request)
    {
        $lists = $this->board->get($request);
        return view("admin.contents.news.index", [
            "lists" => $lists->lists
        ]);
    }

    public function create()
    {
        return view("admin.contents.news.create", [
            "action" => "/b1BjW55p/contents/news"
        ]);
    }

    public function store(Request $request)
    {
        $write = $this->board->write($request);
        if ($write)
        {
            return redirect("/b1BjW55p/contents/news")->with("msg", "글을 작성했습니다.");
        }
        else
        {
            return back()->with("error", "문제가 발생했습니다. 다시 시도해 주세요");
        }
    }


    public function show($id)
    {
        return view("admin.contents.news.show");
    }

    public function edit(BoardNotice $id)
    {
        $original_name = DB::table("attachments")->where("id", $id->thumbnail)->first()->original_name ?? "";

        return view("admin.contents.news.create", [
            "notice" => $id,
            "edit" => true,
            "action" => "/b1BjW55p/contents/news/{$id->id}",
            "original_name" => $original_name
        ]);
    }

    public function update(Request $request)
    {
        $update = $this->board->update($request);
        if ($update)
        {
            return redirect("/b1BjW55p/contents/news")->with("msg", "수정했습니다.");
        }
        else
        {
            return back()->with("error", "문제가 발생했습니다. 다시 시도해 주세요");
        }
    }


    public function destroy($id)
    {
        $delete = $this->board->adminDelete($id);
        if ($delete)
        {
            return redirect("/b1BjW55p/contents/news")->with("msg", "삭제했습니다.");
        }
        else
        {
            return back()->with("error", "문제가 발생했습니다. 다시 시도해 주세요");
        }
    }
}
