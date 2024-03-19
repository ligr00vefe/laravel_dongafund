<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewDonationsAndProgramsAndPaymentsAndStatus extends Model
{
    use HasFactory;
    protected $table = "view_donations_and_programs_and_payments_and_status";
    protected $perPage = 15;

    public static function get($request)
    {
        $from_date = $request->input("from_date") ?? false;
        $to_date = $request->input("to_date") ?? false;
        $payment_type = $request->input("payment_type") ?? false;
        $payment_status = $request->input("payment_status") ?? false;

        return ViewDonationsAndProgramsAndPaymentsAndStatus::when($from_date, function ($query, $from_date) {
            return $query->where("created_at", ">=", $from_date);
        })
            ->when($to_date, function ($query, $to_date) {
                return $query->where("created_at", "<", date("Y-m-d", strtotime($to_date . "+1 days")));
            })
            ->when($payment_type, function ($query, $payment_type) {
                return $query->where("payment_type", "=", $payment_type);
            })
            ->when($payment_status, function ($query, $payment_status) {
                return $query->where("payment_status", "=", $payment_status);
            })
            ->orderByDesc("id")
            ->paginate();
    }
}
