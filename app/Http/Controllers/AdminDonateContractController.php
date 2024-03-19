<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionLogs;
use App\Models\ViewDonationsAndProgramsAndPaymentsAndStatus;
use Illuminate\Http\Request;

class AdminDonateContractController extends Controller
{

    public function __construct(Request $request)
    {
        $category = $request->input("category") ?? "";
        $querystring = urldecode(http_build_query($request->query()));

        view()->share("category", $category);
        view()->share("querystring", $querystring);
    }


    public function index(Request $request)
    {

        $lists = ViewDonationsAndProgramsAndPaymentsAndStatus::get($request);
        return view("admin.donate.contract.index", [
            "lists" => $lists
        ]);

    }

    public function show($id)
    {
        $data = ViewDonationsAndProgramsAndPaymentsAndStatus::find($id);
        $logs = false;
        if ($data->donation_type == "정기기부" || $data->donation_type == "분할납부") {
            $logs = SubscriptionLogs::where("payment_id", "=", $data->payment_id)->orderByDesc("id")->get();
        }

        return view("admin.donate.contract.show", [
            "data" => $data,
            "logs" => $logs
        ]);
    }

}
