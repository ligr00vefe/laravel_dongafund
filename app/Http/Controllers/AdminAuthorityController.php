<?php

namespace App\Http\Controllers;

use App\Models\AdminPermission;
use App\Models\ViewAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAuthorityController extends Controller
{
    public function index(Request $request)
    {
        $lists = AdminPermission::get($request);
        return view("admin.auth.index", [
            "lists" => $lists
        ]);
    }

    public function create(Request $request)
    {
        return view("admin.auth.create", [
            "action" => "/b1BjW55p/auth"
        ]);
    }

    public function show($id)
    {
        return view("admin.auth.create", [
            "post" => $id,
            "action" => "/b1BjW55p/auth"
        ]);
    }

    public function edit($id)
    {
        $post = ViewAdmin::getOne($id);
        return view("admin.auth.create", [
            "post" => $post,
            "edit" => 1,
            "action" => "/b1BjW55p/auth/{$post->id}"
        ]);
    }


    public function store(Request $request)
    {
        $add = AdminPermission::add($request);

        if ($add)
        {
            return redirect("/b1BjW55p/auth")->with("msg", "관리자권한을 업데이트 했습니다");
        }
        else
        {
            return back();
        }
    }

    public function update(Request $request)
    {
        $modify = AdminPermission::add($request);
        if ($modify)
        {
            return redirect("/b1BjW55p/auth")->with("msg", "관리자권한을 업데이트 했습니다");
        }
        else
        {
            return back();
        }
    }

    public function destroy($id)
    {
        $delete = AdminPermission::destroy($id);

        if ($delete)
        {
            return redirect("/b1BjW55p/auth")->with("msg", "관리자권한을 삭제했습니다");
        }
        else
        {
            return back()->with("error", "삭제에 실패했습니다. 설정된 권한이 없거나 일시적인 오류입니다.");
        }
    }

    public function delete(Request $request)
    {
        $delete = AdminPermission::deleteAll($request);

        return response()->json([
            "result" => $delete
        ]);
    }

}
