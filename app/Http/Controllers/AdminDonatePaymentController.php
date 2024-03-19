<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDonatePaymentController extends Controller
{
    public function index(Request $request)
    {
        $from_date = $request->input("from_date") ?? false;
        $to_date = $request->input("to_date") ?? false;
        $payment_type = $request->input("payment_type") ?? false;

        $lists = DB::table("view_payments")
            ->when($from_date, function ($query, $from_date) {
                return $query->where("created_at", ">=", $from_date);
            })
            ->when($to_date, function ($query, $to_date) {
                return $query->where("created_at", "<", date("Y-m-d", strtotime($to_date . "+1 days")));
            })
            ->when($payment_type, function ($query, $payment_type) {
                return $query->where("payment_type", "=", $payment_type);
            })
            ->orderByDesc("id")
            ->paginate();

        $category = [];

        return view("admin.donate.payment.index", [
            "lists" => $lists,
            "category" => $category ?? false
        ]);
    }
}
