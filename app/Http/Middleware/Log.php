<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class Log
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
        // 발전기금은 비회원 활동이 많으므로 굳이 로그인이 안되어 있어도 괜찮음. 나중에 익명으로 수정해야 함!
        $user = Auth::id() ?? DB::table("users")->where("id", "=", 1)->first()->id;

//        if (!$user) return $next($request);

        $account_id = $user->account_id ?? "익명";

        $route_name = Route::currentRouteName();
        $target = $user;
        $comment = "";
        $action = "";
        $category = "";;
        $keyword = "";
        $ip = $request->getClientIp();
        $path = $request->getPathInfo();
        $isSearch = false;
        if(!empty($request->input("term"))){
            $isSearch = true;
        }

        switch ($route_name)
        {
            case "main":
                $comment = "{$account_id}님이 메인에 접근했습니다";
                $action = "메인";
                break;
            case "account":
                $comment = "{$account_id}님이 정보수정 페이지에 접근했습니다";
                $action = "정보수정";
                break;

            case "async.donate.add":
                $comment = "{$account_id}님이 비동기(자동이체)를 통해서 약정서를 생성했습니다";
                $action = "약정서 생성(자동이체)";
                break;

            case "async.kakao.auth.request":
                $comment = "{$account_id}님이 카카오 전자서명을 요청했습니다";
                $action = "카카오 전자서명 서명요청";
                break;

            case "async.kakao.auth.state":
                $comment = "{$account_id}님이 카카오 전자서명을 하고 상태를 확인했습니다";
                $action = "카카오 전자서명 상태확인";
                break;

            case "async.kakao.auth.verify":
                $comment = "{$account_id}님이 카카오 전자서명 검증을 요청했습니다";
                $action = "카카오 전자서명 검증요청";
                break;

            case "async.news.more":
                $comment = "{$account_id}님이 기부소식 게시판 더보기 요청을 했습니다";
                $action = "기부소식 더보기";
                break;

            case "async.periodicals.more":
                $comment = "{$account_id}님이 정기간행물 게시판 더보기 요청을 했습니다";
                $action = "정기간행물 더보기";
                break;

            case "async.signature.save":
                $comment = "{$account_id}님이 일반 전자서명을 저장했습니다";
                $action = "전자서명저장";
                break;

            case "async.support.more":
                $category = $request->input("category") ?? "";
                $comment = "{$account_id}님이 기부프로그램 게시판 더보기 요청을 했습니다";
                $action = "기부프로그램 더보기";
                break;

            case "auth.change.index":
                $comment = "{$account_id}님이 개인정보변경 페이지에 접근했습니다";
                $action = "개인정보변경접근";
                break;

            case "auth.check.index":
                $comment = "{$account_id}님이 본인인증 페이지에 접근했습니다";
                $action = "본인인증접근";
                break;

            case "auth.check.store":
                $comment = "{$account_id}님이 본인인증 페이지에서 본인인증을 요청했습니다";
                $action = "본인인증요청";
                break;

            case "login.index":
                $comment = "{$account_id}님이 로그인 페이지에 접근했습니다";
                $action = "로그인접근";
                break;

            case "login.store":
                $comment = "{$account_id}님이 로그인 요청했습니다";
                $action = "로그인요청";
                break;

            case "benefit.index":
                $comment = "{$account_id}님이 세제혜택 페이지에 접근했습니다";
                $action = "세제혜택접근";
                break;

            case "donate.index":
                $program = $request->input("program");
                $comment = "{$account_id}님이 {$program}번 기부 프로그램으로 약정서 작성 페이지에 접근했습니다";
                $action = "약정서작성접근";
                break;

            case "donate.store":
                $comment = "{$account_id}님이 약정서 저장 요청을 했습니다";
                $action = "약정서 저장 요청";
                break;

            case "donate.complete.index":
                $comment = "{$account_id}님이 기부를 완료했습니다";
                $action = "기부완료";
                break;

            case "donate.kakaopay.complete":
                $comment = "{$account_id}님이 카카오페이 결제를 요청했습니다";
                $action = "카카오페이 결제요청";
                break;

            case "donate.kakaopay.getSid":
                $comment = "{$account_id}님이 카카오페이 sid발급을 요청했습니다";
                $action = "카카오페이 sid발급요청";
                break;

            case "donate.popbill.check":
                $comment = "{$account_id}님이 팝빌 예금주조회를 요청했습니다";
                $action = "팝빌 예금주조회요청";
                break;

            case "fame.index":
                $comment = "{$account_id}님이 기부자예우 페이지에 접근했습니다";
                $action = "기부자예우 접근";
                break;

            case "intro.index":
                $comment = "{$account_id}님이 기부하기 인트로페이지에 접근했습니다";
                $action = "기부하기 인트로페이지 접근";
                break;

            case "history.index":
                $comment = "{$account_id}님이 기부내역 조회페이지에 접근했습니다";
                $action = "기부내역 조회접근";
                break;

            case "mail.address.index":
                $comment = "{$account_id}님이 우편물 관리페이지에 접근했습니다";
                $action = "우편물 관리페이지 조회접근";
                break;

            case "mail.number.index":
                $comment = "{$account_id}님이 우편물 관리페이지(발송일련번호입력)에 접근했습니다";
                $action = "우편물 관리페이지 조회접근";
                break;

            case "news.index":
                if($isSearch){
                    $comment = "{$account_id}님이 기부소식페이지에서 {$request->input("term")} 을 검색했습니다";
                    $category = "기부소식";
                    $action = "기부소식 페이지 검색";
                    $keyword = $request->input("term");
                } else {
                    $comment = "{$account_id}님이 기부소식페이지에 접근했습니다";
                    $action = "기부소식 페이지접근";
                }
                break;

            case "news.show":
                $id = $request->input("news");
                $comment = "{$account_id}님이 기부소식 {$id}번 글에 접근했습니다";
                $action = "기부소식 상세페이지접근";
                break;

            case "partners.index":
                $comment = "{$account_id}님이 협정체결기관페이지에 접근했습니다";
                $action = "협정체결기관 페이지접근";
                break;

            case "periodicals.index":
                if($isSearch){
                    $comment = "{$account_id}님이 정기간행물페이지에서 {$request->input("term")} 을 검색했습니다";
                    $category = '정기간행물';
                    $action = "정기간행물 페이지 검색";
                    $keyword = $request->input("term");
                } else {
                    $comment = "{$account_id}님이 정기간행물페이지 접근했습니다";
                    $action = "정기간행물 페이지접근";
                }
                break;

            case "receipt.index":
                $comment = "{$account_id}님이 기부금 영수증 접근했습니다";
                $action = "기부금 영수증 페이지접근";
                break;

            case "signature.index":
                $comment = "{$account_id}님이 결제서명페이지에 접근했습니다";
                $action = "결제서명페이지에 접근";
                break;

            case "signature.store":
                $comment = "{$account_id}님이 결제서명페이지을 완료하고 결제를 요청했습니다";
                $action = "결제 요청";
                break;

            case "sponsors.index":
                $comment = "{$account_id}님이 후원의 집에 접근했습니다";
                $action = "후원의 집 접근";
                break;

            case "sponsors.show":
                $id = $request->input("sponsor");
                $comment = "{$account_id}님이 후원의 집 {$id}번 글에 접근했습니다";
                $action = "후원의 집 상세페이지접근";
                break;

            case "status.index":
                $comment = "{$account_id}님이 모금현황 페이지에 접근했습니다";
                $action = "모금현황 페이지접근";
                break;

            case "support.index":
                if($isSearch){
                    $comment = "{$account_id}님이 기부 프로그램 페이지에서 {$request->input("term")} 을 검색했습니다";
                    $action = "기부 프로그램 검색";
                    $category = haveCate($request);
                    $keyword = $request->input("term");
                } else {
                    $comment = "{$account_id}님이 기부 프로그램 페이지에 접근했습니다";
                    $action = "기부 프로그램 페이지접근";
                }

                break;

            case "support.show":
                $id = $request->input("support");
                $comment = "{$account_id}님이 기부 프로그램 {$id}번 글에 접근했습니다";
                $action = "기부 프로그램 상세페이지접근";
                break;

            /*-----------------------관리자----------------------*/
            case "admin.auth.index":
                $comment = "{$account_id}님이 관리자 권한관리 페이지에 접근했습니다";
                $action = "관리자 권한관리 페이지접근";
                break;
            case "admin.auth.edit":
                $id = $request->input("auth");
                $comment = "{$account_id}님이 관리자 권한관리 {$id}번 수정페이지에 접근했습니다";
                $action = "관리자 권한관리 수정페이지접근";
                break;
            case "admin.auth.update":
                $id = $request->input("auth");
                $comment = "{$account_id}님이 {$id}번 관리자 권한을 수정했습니다";
                $action = "관리자 권한관리 수정";
                break;
            case "admin.auth.create":
                $comment = "{$account_id}님이 관리자 권한관리 작성페이지에 접근했습니다";
                $action = "관리자 권한관리 작성페이지";
                break;
            case "admin.auth.store":
                $comment = "{$account_id}님이 관리자 권한을 새로 작성했습니다";
                $action = "관리자 권한작성";
                break;
            case "admin.auth.destroy":
                $id = $request->input("auth");
                $comment = "{$account_id}님이 {$id}번 관리자 권한을 삭제했습니다";
                $action = "관리자 권한삭제";
                break;
            case "admin.auth.delete":
                $comment = "{$account_id}님이 선택관리자 권한을 삭제했습니다";
                $action = "관리자 권한 선택삭제";
                break;

            case "admin.contents.contract.index":
                $comment = "{$account_id}님이 관리자 협약서페이지에 접근했습니다";
                $action = "관리자 협약서페이지";
                break;

            case "admin.contents.contract.create":
                $comment = "{$account_id}님이 관리자 협약서 작성페이지에 접근했습니다";
                $action = "관리자 협약서 작성페이지";
                break;

            case "admin.contents.contract.store":
                $comment = "{$account_id}님이 관리자 협약서를 작성했습니다";
                $action = "관리자 협약서 작성";
                break;

            case "admin.contents.contract.edit":
                $id = $request->input("id") ?? 0;
                $comment = "{$account_id}님이 관리자 {$id}번 협약서 수정 페이지에 접근했습니다";
                $action = "관리자 협약서 수정페이지접근";
                break;

            case "admin.contents.contract.update":
                $id = $request->input("id") ?? 0;
                $comment = "{$account_id}님이 관리자 {$id}번 협약서를 수정했습니다";
                $action = "관리자 협약서 수정";
                break;

            case "admin.contents.contract.destroy":
                $id = $request->input("id") ?? 0;
                $comment = "{$account_id}님이 관리자 {$id}번 협약서를 삭제했습니다";
                $action = "관리자 협약서 삭제";
                break;

            case "admin.contents.news.index":
                $comment = "{$account_id}님이 관리자 기부소식페이지에 접근했습니다";
                $action = "관리자 기부소식접근";
                break;

            case "admin.contents.news.create":
                $comment = "{$account_id}님이 관리자 기부소식 작성페이지에 접근했습니다";
                $action = "관리자 기부소식 작성페이지접근";
                break;

            case "admin.contents.news.store":
                $comment = "{$account_id}님이 관리자 기부소식을 작성했습니다";
                $action = "관리자 기부소식 작성";
                break;

            case "admin.contents.news.edit":
                $id = $request->input("id") ?? 0;
                $comment = "{$account_id}님이 관리자 {$id}번 기부소식 글 수정페이지에 접근했습니다";
                $action = "관리자 기부소식 수정페이지 접근";
                break;

            case "admin.contents.news.update":
                $id = $request->input("id") ?? 0;
                $comment = "{$account_id}님이 관리자 {$id}번 기부소식 글을 수정했습니다";
                $action = "관리자 기부소식 수정";
                break;

            case "admin.contents.news.destroy":
                $id = $request->input("id") ?? 0;
                $comment = "{$account_id}님이 관리자 {$id}번 기부소식 글을 삭제했습니다";
                $action = "관리자 기부소식 삭제";
                break;

            case "admin.contents.periodicals.index":
                $comment = "{$account_id}님이 관리자 정기간행물 페이지에 접근했습니다";
                $action = "관리자 정기간행물페이지접근";
                break;

            case "admin.contents.periodicals.create":
                $comment = "{$account_id}님이 관리자 정기간행물 글작성 페이지에 접근했습니다";
                $action = "관리자 정기간행물 글작성 페이지접근";
                break;

            case "admin.contents.periodicals.store":
                $comment = "{$account_id}님이 관리자 정기간행물을 작성했습니다";
                $action = "관리자 정기간행물작성";
                break;

            case "admin.contents.periodicals.edit":
                $id = $request->input("id") ?? 0;
                $comment = "{$account_id}님이 관리자 {$id}번 정기간행물 글 수정페이지에 접근했습니다";
                $action = "관리자 정기간행물 수정페이지접근";
                break;

            case "admin.contents.periodicals.update":
                $id = $request->input("id") ?? 0;
                $comment = "{$account_id}님이 관리자 {$id}번 정기간행물 글을 수정했습니다";
                $action = "관리자 정기간행물 수정";
                break;

            case "admin.contents.periodicals.destroy":
                $id = $request->input("id") ?? 0;
                $comment = "{$account_id}님이 관리자 {$id}번 정기간행물 글을 삭제했습니다";
                $action = "관리자 정기간행물 삭제";
                break;

            case "admin.donate.contract.index":
                $comment = "{$account_id}님이 관리자 약정 관리페이지에 접근했습니다";
                $action = "관리자 약정관리페이지접근";
                break;

            case "admin.donate.contract.create":
                $comment = "{$account_id}님이 관리자 약정 관리 작성페이지에 접근했습니다";
                $action = "관리자 약정관리 작성페이지접근";
                break;

            case "admin.donate.contract.store":
                $comment = "{$account_id}님이 관리자 약정 관리를 작성했습니다";
                $action = "관리자 약정관리 작성";
                break;

            case "admin.donate.contract.show":
                $id = $request->input("contract");
                $comment = "{$account_id}님이 관리자 약정 관리 {$id}번 게시물을 조회했습니다";
                $action = "관리자 약정관리 조회";
                break;

            case "admin.donate.contract.edit":
                $id = $request->input("contract");
                $comment = "{$account_id}님이 관리자 약정 관리 {$id}번 게시물을 수정페이지에 접근했습니다";
                $action = "관리자 약정관리 수정페이지 접근";
                break;

            case "admin.donate.contract.update":
                $id = $request->input("contract");
                $comment = "{$account_id}님이 관리자 약정 관리 {$id}번 게시물을 수정했습니다";
                $action = "관리자 약정관리 수정";
                break;

            case "admin.donate.contract.destroy":
                $id = $request->input("contract");
                $comment = "{$account_id}님이 관리자 약정 관리 {$id}번 게시물을 삭제했습니다";
                $action = "관리자 약정관리 삭제";
                break;

            case "admin.donate.excel.contract":
                $comment = "{$account_id}님이 관리자 약정관리 엑셀 선택지페이지에 접근했습니다";
                $action = "관리자 약정관리 엑셀 선택지페이지에 접근";
                break;

            case "admin.donate.program.index":
                $comment = "{$account_id}님이 관리자 기부 프로그램 관리에 접근했습니다";
                $action = "관리자 기부 프로그램 관리 접근";
                break;

            case "admin.donate.program.create":
                $comment = "{$account_id}님이 관리자 기부 프로그램 관리 작성페이지에 접근했습니다";
                $action = "관리자 기부 프로그램 관리 작성페이지 접근";
                break;

            case "admin.donate.program.store":
                $comment = "{$account_id}님이 관리자 기부 프로그램 관리를 작성했습니다";
                $action = "관리자 기부 프로그램 관리 작성";
                break;

            case "admin.donate.program.show":
                $id = $request->input("id");
                $comment = "{$account_id}님이 관리자 기부 프로그램 관리 {$id}번 글을 조회했습니다";
                $action = "관리자 기부 프로그램 관리 조회";
                break;

            case "admin.donate.program.edit":
                $id = $request->input("id");
                $comment = "{$account_id}님이 관리자 기부 프로그램 관리 {$id}번 글 수정페이지에 접근했습니다";
                $action = "관리자 기부 프로그램 관리 수정페이지 접근";
                break;

            case "admin.donate.program.update":
                $id = $request->input("id");
                $comment = "{$account_id}님이 관리자 기부 프로그램 관리 {$id}번 글을 수정했습니다";
                $action = "관리자 기부 프로그램 관리 수정";
                break;

            case "admin.donate.program.destroy":
                $id = $request->input("id");
                $comment = "{$account_id}님이 관리자 기부 프로그램 관리 {$id}번 글을 삭제했습니다";
                $action = "관리자 기부 프로그램 관리 삭제";
                break;

            case "admin.donate.program.select.update":
                $comment = "{$account_id}님이 관리자 기부 프로그램 관리 선택 글 수정을 했습니다";
                $action = "관리자 기부 프로그램 관리 선택 수정";
                break;

            case "admin.donate.sending.contract.index":
                $comment = "{$account_id}님이 관리자 약정관리 시스템 전송페이지에 접근했습니다";
                $action = "관리자 약정관리 시스템 전송페이지 접근";
                break;

            case "admin.excel.export.contract":
                $comment = "{$account_id}님이 관리자 약정관리 엑셀을 다운로드했습니다";
                $action = "관리자 약정관리 엑셀 다운로드";
                break;

            case "admin.excel.export.log.adminPermission":
                $comment = "{$account_id}님이 관리자 권한변경 로그를 다운로드했습니다";
                $action = "관리자 권한변경 로그 다운로드";
                break;

            case "admin.log.auth.index":
                $comment = "{$account_id}님이 관리자 권한부여 내역페이지에 접근했습니다";
                $action = "관리자 권한부여 내역페이지 접근";
                break;

            case "admin.privacy.agreement.index":
                $comment = "{$account_id}님이 관리자 개인정보 동의 내역페이지에 접근했습니다";
                $action = "관리자 권한부여 내역페이지 접근";
                break;

            case "admin.inquire.agreement.index":
                $comment = "{$account_id}님이 관리자 개인정보 조회 내역페이지에 접근했습니다";
                $action = "관리자 개인정보 조회 내역페이지 접근";
                break;

            case "admin.excel.export.privacy.index":
                $comment = "{$account_id}님이 관리자 개인정보 조회내역 엑셀다운로드페이지에 접근했습니다";
                $action = "관리자 개인정보 조회내역 엑셀다운로드페이지 접근";
                break;

            case "admin.excel.export.privacy.download":
                $comment = "{$account_id}님이 관리자 개인정보 조회내역을 다운로드했습니다";
                $action = "관리자 개인정보 조회내역 엑셀다운로드";
                break;

            case "admin.excel.export.agreement.download":
                $comment = "{$account_id}님이 관리자 개인정보 동의내역을 다운로드했습니다";
                $action = "관리자 개인정보 동의내역 엑셀다운로드";
                break;

            case "admin.excel.export.payment":
                $comment = "{$account_id}님이 관리자 결제승인내역을 다운로드했습니다";
                $action = "관리자 결제승인내역 엑셀다운로드";
                break;

        }

        $record = \App\Models\Log::record([
            "user_id" => $user,
            "action" => $action,
            "route" => $route_name,
            "target" => $target,
            "path" => $path,
            "comment" => $comment,
            "ip" => $ip,
            "keyword" => $keyword,
            "category" => $category,
        ]);

        /* 후처리 있는 경우   */
        switch ($route_name)
        {
            case "admin.excel.export.privacy.download":
                $reason = $request->input("reason") ?? "";
                DB::table("reasons")
                    ->insert([
                        "log_id" => $record,
                        "reason" => $reason
                    ]);
                break;
        }



        return $next($request);
    }
}
