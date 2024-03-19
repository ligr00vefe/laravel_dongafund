<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminPermission extends Model
{
    use HasFactory;
    protected $table = "admin_permission";
    protected $perPage = 15;

    protected static array $permissionKind = [
        "기부금 관리", "예우대상자 풀", "기부 프로그램 관리",
        "전자모금함 관리", "컨텐츠 관리", "개인정보 관리"
    ];

    public static function getOne($id)
    {
        return DB::table("admin_permission")
            ->when($id, function ($query, $id) {
                return $query->where("id", "=", $id);
            })
            ->first();
    }

    public static function get($request)
    {
        $id = $request->input("id");

        return DB::table("admin_permission")
            ->when($id, function ($query, $id) {
                return $query->where("id", "=", $id);
            })
            ->paginate();
    }



    public static function add($request)
    {

        $permissions = $request->input("permissions");
        $permissionString = "";

        foreach ($permissions as $permission) {
            if (!in_array($permission, self::$permissionKind)) {
                session()->flash("error", "해당하지않는 권한입니다");
                return false;
            }

            $permissionString .= $permissionString == "" ? $permission : ",".$permission;
        }

        $account_id = $request->input("account_id");
        $expire_date = $request->input("expire_date");
        $ip = $request->input("ip");
//        $account = DB::table("users")->where("account_id", "=", $account_id)->first() ?? false;
//        if (!$account) {
            /* 이 부분에 SSO 연동해야 할 수도... */
//            session()->flash("error", "존재하지 않는 계정입니다");
//            return false;
//        }

        $exists = DB::table("admin_permission")->where("account_id", "=", $account_id)->exists();

        $execute = DB::table("admin_permission")
            ->updateOrInsert(
                [
                    "account_id" => $account_id
                ],
                [
                    "permissions" => $permissionString,
                    "expire_date" => $expire_date,
                    "ip" => $ip
                ]
            );

        if ($execute) {

            $action = $exists ? "변경" : "생성";
            $record = [
                "user_id" => Auth::id() ?? 1,
                "action" => $action,
                "target" => $account_id,
                "comment" => $permissionString,
                "path" => $request->getPathInfo(),
                "ip" => $request->getClientIp()
            ];

            AdminPermissionLog::record($record);

            $record['action'] = "관리자 권한 " . $action;
            Log::record($record);

        }

        return $execute;

    }


    public static function deleteAll($request)
    {
        $ids = explode(",", $request->input("ids"));

        return DB::table("admin_permission")
            ->whereIn("id", $ids)
            ->delete();
    }

}
