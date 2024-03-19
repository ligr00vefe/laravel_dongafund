<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DonationProgram extends Model
{
    use HasFactory;
    protected $table = "donation_programs";

    // 사용 X
    public static function get(array $where=[], $limit=false)
    {
        return DonationProgram
            ::where($where)
            ->when($limit, function ($query, $limit) {
                return $query->limit($limit);
            })
            ->get();
    }

    public static function getOne(array $where=[], $limit=false)
    {
        return DonationProgram::where($where); // 중단
    }

    /*
     * 페이지네이션 리턴 (and와 or 혼합이 안되서 사용 보류...)
     * * parameters:
     * * * $wheres -> where 문 안에 들어갈 내용. [ ['컬럼명', '부등호', '밸류'], [...], ]
     * * * $pagination -> 페이지에 몇개
     * * * $type = 'and', 'or'
     * * return:
     * * * paging -> 총 갯수
     * * * lists -> 리스트
     * */
    public static function paginate(array $wheres=[], $pagination=15, $type="or") : \stdClass
    {
        $query = DB::table("donation_programs");

        foreach ($wheres as $where)
        {
            if ($type == "or") {
                $query = $query->orWhere([[$where[0], $where[1], $where[2]]]);
            } else if ($type == "and") {
                $query = $query->where([[$where[0], $where[1], $where[2]]]);
            }
        }

        $object = new \stdClass();
        $object->paging = $query->count();
        $object->lists = $query->orderByDesc("id")->paginate($pagination);

        return $object;
    }
}
