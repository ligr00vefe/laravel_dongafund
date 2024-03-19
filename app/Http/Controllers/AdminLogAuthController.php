<?php

namespace App\Http\Controllers;

use App\Models\ViewAdminPermissionLog;
use Illuminate\Http\Request;

class AdminLogAuthController extends Controller
{

    public function index(Request $request)
    {
        $lists = ViewAdminPermissionLog::paging($request);
        return view("admin.log.auth.index", [
            "lists" => $lists ?? []
        ]);
    }

}
