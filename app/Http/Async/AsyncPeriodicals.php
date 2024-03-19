<?php
namespace App\Http\Async;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Boards\Periodicals;


class AsyncPeriodicals extends Periodicals
{
    protected int $paging = 6;

    public function more(Request $request)
    {
        $lists = parent::get($request)->lists;
        return view("periodicals.include.more", [
            "lists" => count($lists) > 0 ? $lists : []
        ]);
    }

}
