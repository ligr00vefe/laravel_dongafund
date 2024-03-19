<?php

namespace App\Http\Controllers;

use App\Boards\Contract;
use App\Models\BoardContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminContractManagementController extends Controller
{
    // 모든 메서드에서 쓸 수 있도록 생성해준다
    protected Contract $board;

    public function __construct(Request $request)
    {
        $this->board = new Contract();

        $category = $request->input("category") ?? "";
        view()->share("category", $category);
    }

    public function index(Request $request)
    {
        // 게시글 가져오기
        $lists = $this->board->get($request);

        return view("admin.contents.contract.index", [
            "lists" => $lists->lists
        ]);
    }

    public function create(Request $request)
    {
        return view("admin.contents.contract.create", [
            "action" => "/b1BjW55p/contents/contract"
        ]);
    }


    public function store(Request $request)
    {
        $write = $this->board->write($request);

        if ($write)
        {
            return redirect("/b1BjW55p/contents/contract")->with("msg", "글을 작성했습니다.");
        }
        else
        {
            return back()->with("error", "문제가 발생했습니다. 다시 시도해 주세요");
        }
    }


    public function show($id)
    {
        return view("admin.contents.contract.show");
    }


    public function edit(BoardContract $id)
    {
        $file_name = DB::table("attachments")->where("id", $id->attachment1)->first()->original_name ?? "";
        $original_name = DB::table("attachments")->where("id", $id->thumbnail)->first()->original_name ?? "";

        $raw_from_date = DB::table("board_contract")->where("id", $id->id)->first()->from_date ?? "";
        $from_date = substr($raw_from_date, 0, 10);

        return view("admin.contents.contract.create", [
            "contract" => $id,
            "edit" => true,
            "action" => "/b1BjW55p/contents/contract/{$id->id}",
            "original_name" => $original_name,
            "file_name" => $file_name,
            "from_date" => $from_date
        ]);
    }

    public function update(Request $request)
    {
        $update = $this->board->update($request);
        if ($update)
        {
            return redirect("/b1BjW55p/contents/contract")->with("msg", "수정했습니다.");
        }
        else
        {
            return back()->with("error", "문제가 발생했습니다. 다시 시도해 주세요");
        }
    }


    public function destroy($id)
    {
        // 게시긇 id만 넘기면 됨.
        $delete = $this->board->adminDelete($id);
        if ($delete)
        {
            return redirect("/b1BjW55p/contents/contract")->with("msg", "삭제했습니다.");
        }
        else
        {
            return back()->with("error", "문제가 발생했습니다. 다시 시도해 주세요");
        }
    }
}
