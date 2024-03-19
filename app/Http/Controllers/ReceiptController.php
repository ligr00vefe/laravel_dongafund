<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceiptController extends Controller
{

    public function index(Request $request)
    {
        $loungeType = $request->input("loungeType") ?? "news";
        $type = $request->input("type") ?? "2021";

        return redirect("/auth/check?return=%2receipt");

        switch ($loungeType) {
            case 'news':
                break;
            case 'report':
                break;
            case 'status':
                break;
            case 'fame':
                break;
            case 'honor':
                break;
            case 'benefit':
                break;
            case 'history':
                break;
            case 'receipt':
                break;
            default: break;
        }

        switch ($type) {
            case '2021':
                break;
            case '2020':
                break;
            case '2019':
                break;
            case '2018':
                break;
            case '2017':
                break;
            default: break;
        }
        return view("receipt.index", [
            "loungeType" => $loungeType,
            "type" => $type
        ]);


    }
}
