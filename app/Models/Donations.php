<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donations extends Model
{
    use HasFactory;
    protected $table = "donations";
    protected $guarded = [ "id", "signature_save_id", "payment_status", "created_at", "updated_at" ];

    public function program()
    {
        return $this->belongsTo("App\Models\DonationProgram", "program_id");
    }
}
