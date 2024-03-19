<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ViewAdminPermissionLog extends Model
{
    use HasFactory;
    protected $table = "view_admin_permission_logs";

    public static function paging($request) {

        $keyword = $request->input("keyword");

        return DB::table("view_admin_permission_logs")
            ->when($keyword, function ($query, $keyword) {
                return $query->where("name", "like", "%{$keyword}%");
            })
            ->orderByDesc("id")
            ->paginate();
    }
}
