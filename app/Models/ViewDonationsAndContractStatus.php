<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewDonationsAndContractStatus extends Model
{
    use HasFactory;
    protected $table = "view_donations_and_contract_status";
    protected $perPage = 15;


}
