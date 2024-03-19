<?php
namespace App\Http\Async;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Boards\Notice;


class AsyncNotice extends Notice
{
    protected int $paging = 3;
    protected int $offset;
    protected array $notIn = [];

    public function more(Request $request)
    {
        $notIn = [ $request->input("notIn") ];
        $this->setNotIn($notIn);
        $lists = parent::get($request)->lists;
        return view("news.include.more", [
            "lists" => count($lists) > 0 ? $lists : []
        ]);
    }
 //
}
