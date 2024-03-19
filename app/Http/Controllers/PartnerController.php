<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Boards\Contract;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $contract = new Contract();
        $contract->setPaging(16);
        $lists = $contract->get($request);

        return view("partner.index", [
            "lists" => $lists->lists
        ]);
    }

    public function show($id)
    {
        return view("partner.show", [
            "id" => $id
        ]);
    }

}
