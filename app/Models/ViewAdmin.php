<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ViewAdmin extends Model
{
    use HasFactory;
    protected $table = "view_admin";
    protected $perPage = 15;

    public static function getOne($id)
    {
        return DB::table("view_admin")
            ->when($id, function ($query, $id) {
                return $query->where("permission_id", "=", $id);
            })
            ->first();
    }

    public static function get($request)
    {
        $keyword = $request->input("keyword");
        $id = $request->input("id");

        return DB::table("view_admin")
            ->when($keyword, function ($query, $keyword) {
                return $query->whereRaw("(name like ? or account_id like ?)", [ "%{$keyword}%", "%{$keyword}%" ]);
            })
            ->when($id, function ($query, $id) {
                return $query->where("id", "=", $id);
            })
            ->paginate();
    }
}
