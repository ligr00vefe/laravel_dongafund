<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiAccessIp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        $request_ip = $request->getClientIp();
//        $ip = [
//            "192.168.10.10",
//            "192.168.10.1"
//        ];
//
//        if (!in_array($request_ip, $ip)) {
//            return [ "code" => 9999, "msg" => "접근 불가 ip", "data" => $request_ip ];
//        }

        return $next($request);
    }
}
