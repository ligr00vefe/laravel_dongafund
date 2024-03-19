<?php

use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: BARAEM_programer2
 * Date: 2021-05-06
 * Time: 오후 4:55
 */

// 찍어보기
function pp(...$args)
{
    echo "<pre>";
    print_r($args);
    echo "</pre>";
}

// $var == $value 일 때 'focused' 라는 문자열을 리턴한다. 배열도 지원함. 리턴받는 문자열 수정할 수 있음.
function focused($var, $value=null, $print="focused")
{
    // 변수가 없다면 ""
    if (!$var || !$value) return "";

    // 변수가 배열일때
    if (is_array($var)) {
        // 배열안에 $value가 포함됐다면 focused
        if (in_array($value, $var)) return $print;
        else return "";
    } else {
        // 변수가 배열이 아닐때, 변수와 밸류가 똑같다면
        if ($var == $value) return $print;
        else return "";
    }

}

// id 넣으면 attachments 리턴
function getAttach($id)
{
    return \Illuminate\Support\Facades\DB::table("attachments")
            ->where("id","=",$id)
            ->first() ?? false;
}

// id 넣으면 attachments 첨부파일 패스 리턴
function getAttachPath($id)
{
    return \Illuminate\Support\Facades\DB::table("attachments")
        ->where("id","=",$id)
        ->first()->path ?? false;
}

function getAttachPathWithOutRootPath($id)
{
    $path = \Illuminate\Support\Facades\DB::table("attachments")
        ->where("id","=",$id)
        ->first()->path ?? false;

    if ($path) {
        $path = explode("/public/", $path)[1];
    }

    return $path;
}


// 숫자가 아닌 경우 공백리턴, 숫자인 경우 null 체크 후 number_format으로 리턴
function issetNumberFormat($type=null, $return="")
{
    if (!$type) return "";
    if (!is_numeric($type)) return "";
    return $type ? number_format($type) : $return;
}

// $str안에 $find가 속해있으면 true
function strContain ($str, $find) {
    if ($str == "") return false;
    if (is_numeric($str)) $str .= "";
    if (!is_string($str)) return "";

    if (strpos($str, $find) !== false) {
        return true;
    } else {
        return false;
    }
}


function years_option ($start=1940, $repeat=false) : string
{
    if (!$repeat) $repeat = (int) date("Y");
    $str = "";
    for ($i=$start; $i<=$repeat; $i++) {
        $str .= "<option value='{$i}'>{$i}</option>";
    }
    return $str;
}


function regexp($type, $str) {
    $pattern = "";

    switch ($type)
    {
        case "한글":
            $pattern = '/([\xEA-\xED][\x80-\xBF]{2})+/'; // ㄱ ㄴ ㄷ ㄹ 이런건 안됨
            break;
        case "한글영어":
            $pattern = '/([\xEA-\xED][\x80-\xBF]{2}|[a-zA-Z])+/';
            break;
        case "숫자":
            $pattern = '/([0-9])+/';
            break;
    }

    preg_match_all($pattern, $str, $match);
    return implode('', $match[0]);

}


function stringArrayChecked($string, $split, $compare, $return="checked")
{
    if (!$string || $string == "") return "";
    $arr = explode($split, $string);
    if (in_array($compare, $arr)) {
        return $return;
    } else {
        return "";
    }
}

function querystring($queryArray)
{

    $str = "";
    foreach ($queryArray as $key => $query)
    {
        if ($str != "") $str .= "&";
        $str .= $key . "=" . $query;
    }
    return $str;
}


function routename() {
    return Illuminate\Support\Facades\Route::currentRouteName();
}

function getName($id)
{
    return \Illuminate\Support\Facades\DB::table("users")->where("id", $id)->first()->name ?? "";
}


function curl($url, $req, $headers)
{
    $request_timeout = 10; // 1 second timeout
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, $request_timeout);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $request_timeout);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($req));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    return curl_exec($ch);
}


function getWeekDay($day)
{
    $weekMap = [
        0 => '일',
        1 => '월',
        2 => '화',
        3 => '수',
        4 => '목',
        5 => '금',
        6 => '토',
    ];
    $dayOfTheWeek = \Illuminate\Support\Carbon::now()->dayOfWeek;
    return $weekMap[$dayOfTheWeek];
}


function strip_tags_blink_removing($str)
{
    return strip_tags(str_replace("&nbsp;", "", $str));
}

// 어드민 페이지의 단과대 선택창
function college_type(){
    DB::statement("SET sql_mode = '' ");

    return DB::table("college_type")
        ->groupBy('college')
        ->get();
}

function department_type(){
    return DB::table('college_type')
        ->get();
}



function haveCate($request){
    if(!empty($request->input("category"))){
        switch($request->input("category")){
            case "campaign":
                return '주요 캠페인 지원';
            case "student":
                return '학생 지원';
            case "research":
                return '연구 지원';
            case "college":
                return '단과대/학과 지원';
            case "life":
                return '대학생활 지원';
            default:
                return '';
        }
    }
}
