<?php
namespace App\Http\Async;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Boards\Notice;


class MoreNews extends Notice
{

    protected int $offset = 1;
    protected int $paging = 3;

    public function more(Request $request)
    {
        return response()->json(parent::get($request)->lists);
    }

}
