<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ViewPrivacyAgreements extends Model
{
    use HasFactory;
    protected $table = "view_privacy_agreements";
    protected $perPage = 15;

    public static function get($request)
    {
        $category = $request->input("category") ?? false;
        $from_date = $request->input("from_date") ?? false;
        $to_date = $request->input("to_date") ?? false;
        $keyword = $request->input("keyword") ?? false;

        return DB::table("view_privacy_agreements")
            ->when($category, function ($query, $category) {
                return $query->where("menu", "=", $category);
            })
            ->when($from_date, function ($query, $from_date) {
                return $query->where("created_at", ">=", $from_date . " 00:00:00");
            })
            ->when($to_date, function ($query, $to_date) {
                return $query->where("created_at", "<=", $to_date . " 23:59:59");
            })
            ->when($keyword, function ($query, $keyword) {
                return $query->where("name", "like", "%{$keyword}%");
            })
            ->paginate();
    }
}
