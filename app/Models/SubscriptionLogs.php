<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionLogs extends Model
{
    use HasFactory;
    protected $table = "subscription_logs";

    public static function record($params)
    {
        SubscriptionLogs::insert($params);
    }
}
