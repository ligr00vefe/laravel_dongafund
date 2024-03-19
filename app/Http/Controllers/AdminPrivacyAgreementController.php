<?php

namespace App\Http\Controllers;

use App\Models\ViewPrivacyAgreements;
use Illuminate\Http\Request;

class AdminPrivacyAgreementController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->input("category") ?? null;
        $lists = ViewPrivacyAgreements::get($request);

        return view("admin.privacy.agreement.index", [
            "category" => $category,
            "lists" => $lists,
            "from_date" => $request->input("from_date"),
            "to_date" => $request->input("to_date")
        ]);
    }

    public function show($id)
    {
        return view("admin.privacy.agreement.show", [
            "post" => $id
        ]);
    }
}
