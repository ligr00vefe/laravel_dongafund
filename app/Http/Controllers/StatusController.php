<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index(Request $request)
    {
        $loungeType = $request->input("loungeType") ?? "news";

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

        return view("status.index", [
            "loungeType" => $loungeType
        ]);
    }
}
