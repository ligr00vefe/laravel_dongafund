<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KioskDonations extends Model
{
    use HasFactory;
    protected $table = "kiosk_donations";
    protected $guarded = [ "id", "signature_save_id", "created_at", "updated_at" ];
}
