<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Log extends Model
{
    use HasFactory;
    protected $table = "logs";

    public static function record($data) {

        return DB::table("logs")
            ->insertGetId([
                "user_id" => $data['user_id'],
                "action" => $data['action'] ?? "",
                "route" => $data['route'] ?? "",
                "target" => $data['target'] ?? "",
                "comment" => $data['comment'] ?? "",
                "path" => $data['path'] ?? "",
                "ip" => $data['ip'] ?? "",
                "keyword" => $data['keyword'] ?? "",
                "category" => $data['category'] ?? "",
            ]);

    }
}
