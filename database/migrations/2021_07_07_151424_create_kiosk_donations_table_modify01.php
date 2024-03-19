<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKioskDonationsTableModify01 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('kiosk_donations', function(Blueprint $table){

            // 추가되는 값들 모두 일단 nullable 로 만들예정 어느 부분에서 처음 행이 생성되는지 파악이 안되었음

            // 동아대 회원번호 추가
            $table->string("adm_member_no", 10)->comment("동아대 회원번호 AFD010_MEM_NO")->nullable();
            // 동아대 증서번호 추가
            $table->string("adm_fund_no", 10)->comment("동아대 증서번호 AFD020_FUND_NO")->nullable();
            // 키오스크 약정번호 추가
            $table->char("kiosk_agreement_no", 10)->comment("키오스크에서 보내주는 약정번호")->nullable();
            // 서면 약정번호
            $table->char("doc_agreement_no", 10)->comment("문서 스캔본을 업로드한 약정서를 별도로 관리하기 위한 필드")->nullable();
            // 약정서 최초생성일시
            $table->datetime("donation_first_dt")->comment("약정서 최초 생성 일시")->nullable();
            // 약정서 완료 일시
            $table->datetime("donation_finish_dt")->comment("약정서 완료 일시")->nullable();
            // 기부금 용도
            $table->string("donation_purpose_code", 4)->comment("기부금 프로그램을 구분하는 3자리 키로 쓰이는 코드값")->nullable();
            // 개인 직번
            $table->char("p_donor_emp_id", 6)->comment("개인 직번")->nullable();
            // 개인 학번
            $table->char("p_donor_stdnt_id", 7)->comment("개인 학번")->nullable();
            // 필수 개인정보수집 동의
            $table->integer("consent_collect_rqd_p_info", 11)->comment("필수 개인정보수집 동의")->nullable();
            // 필수 개인정보수집 동의 컨텐츠 인덱스
            $table->char("consent_cnts_rqd_p_info", 50)->comment("필수 개인정보수집 동의 컨텐츠 인덱스")->nullable();
            // 필수 개인정보수집 동의 일시
            $table->datetime("consent_dt_collect_rqd_p_info")->comment("필수 개인정보수집 동의 일시")->nullable();
            // 선택 개인정보수집 동의
            $table->integer("consent_collect_opt_p_info")->comment("선택 개인정보수집 동의")->nullable();
            // 선택 개인정보수집 동의 컨텐츠 인덱스
            $table->char("consent_cnts_opt_p_info", 50)->comment("선택 개인정보수집 동의 컨텐츠 인덱스")->nullable();
            // 선택 개인정보수집 동의 일시
            $table->datetime("consent_dt_collect_opt_p_info")->comment("선택 개인정보수집 동의 일시")->nullable();
            // 개인정보 제3자 제공동의
            $table->integer("consent_provide_p_info_thirdpty", 11)->comment("개인정보 제3자 제공동의")->nullable();
            // 개인정보 제3자 제공동의 컨텐츠 인덱스
            $table->char("consent_cnts_provide_p_info_thirdpty", 50)->comment("개인정보 제3자 제공동의 컨텐츠 인덱스")->nullable();
            // 개인정보 제3자 제공동의 일시
            $table->datetime("consent_dt_provide_p_info_thirdpty")->comment("개인정보 제3자 제공동의 일시")->nullable();
            // 무통장 입금예정일
            $table->string("pay_deposit_due_date", 50)->comment("무통장 입금예정일")->nullable();
            // 아임포트 C_UID
            $table->string("pay_imp_customer_uid", 50)->comment("아임포트 C_UID")->nullable();
            // 아임포트 M_UID
            $table->string("pay_imp_merchant_uid", 50)->comment("아임포트 M_UID")->nullable();
            // 아임포트 UID
            $table->string("pay_imp_uid", 50)->comment("아임포트 UID")->nullable();
            // 카카오 ORDER ID
            $table->string("pay_kakao_order_id", 50)->comment("카카오 ORDER ID")->nullable();
            // 카카오 USER ID
            $table->string("pay_kakao_user_id", 50)->comment("카카오 USER ID")->nullable();
            // 카카오 첫 TID
            $table->string("pay_kakao_first_tid", 50)->comment("카카오 첫 TID")->nullable();
            // 카카오 SID
            $table->string("pay_kakao_sid", 50)->comment("카카오 SID")->nullable();
            // 카카오 AID
            $table->string("pay_kakao_aid", 50)->comment("카카오 AID")->nullable();
            // 네이버 첫 TID (추후 사용예정)
            $table->string("pay_naver_first_tid", 50)->comment("네이버 첫 TID (추후 사용예정)")->nullable();
            // 나이스 첫 TID
            $table->string("pay_nice_first_tid", 50)->comment("나이스 첫 TID")->nullable();
            // 썸패스 sPayID (추후 사용예정)
            $table->string("pay_sumpass_pid", 50)->comment("썸패스 sPayID (추후 사용예정)")->nullable();
            // KSNet 거래번호
            $table->string("pay_ksnet_tid", 50)->comment("KSNet 거래번호")->nullable();
            // KSNet 카드승인번호
            $table->string("pay_ksnet_approval_no", 50)->comment("KSNet 카드승인번호")->nullable();
            // 결제요청금액
            $table->string("pay_request_amt", 50)->comment("결제요청금액")->nullable();
            // SMS발송일시
            $table->string("noti_sms_sd_dt", 50)->comment("SMS발송일시")->nullable();
            // SMS ReceiptNo
            $table->string("noti_sms_rc_no", 50)->comment("SMS ReceiptNo")->nullable();
            // 카카오톡 발송일시
            $table->string("noti_kakao_sd_dt", 50)->comment("카카오톡 발송일시")->nullable();
            // 카카오톡 ReceiptNo
            $table->string("noti_kakao_rc_no", 50)->comment("카카오톡 ReceiptNo")->nullable();
            // 서명데이터
            $table->string("donor_signature", 50)->comment("서명데이터(키값) (직접 그리는 서명 파일)")->nullable();
        });
    }

    public function down()
    {
        Schema::table('kiosk_donations', function($table){
            $table->dropColumn('adm_member_no');
            $table->dropColumn('adm_fund_no');
            $table->dropColumn('kiosk_agreement_no');
            $table->dropColumn('doc_agreement_no');
            $table->dropColumn('donation_first_dt');
            $table->dropColumn('donation_finish_dt');
            $table->dropColumn('donation_purpose_code');
            $table->dropColumn('p_donor_emp_id');
            $table->dropColumn('p_donor_stdnt_id');
            $table->dropColumn('consent_collect_rqd_p_info');
            $table->dropColumn('consent_cnts_rqd_p_info');
            $table->dropColumn('consent_dt_collect_rqd_p_info');
            $table->dropColumn('consent_collect_opt_p_info');
            $table->dropColumn('consent_cnts_opt_p_info');
            $table->dropColumn('consent_dt_collect_opt_p_info');
            $table->dropColumn('consent_provide_p_info_thirdpty');
            $table->dropColumn('consent_cnts_provide_p_info_thirdpty');
            $table->dropColumn('consent_dt_provide_p_info_thirdpty');
            $table->dropColumn('pay_deposit_due_date');
            $table->dropColumn('pay_imp_customer_uid');
            $table->dropColumn('pay_imp_merchant_uid');
            $table->dropColumn('pay_imp_uid');
            $table->dropColumn('pay_kakao_order_id');
            $table->dropColumn('pay_kakao_user_id');
            $table->dropColumn('pay_kakao_first_tid');
            $table->dropColumn('pay_kakao_sid');
            $table->dropColumn('pay_kakao_aid');
            $table->dropColumn('pay_naver_first_tid');
            $table->dropColumn('pay_nice_first_tid');
            $table->dropColumn('pay_sumpass_pid');
            $table->dropColumn('pay_ksnet_tid');
            $table->dropColumn('pay_ksnet_approval_no');
            $table->dropColumn('pay_request_amt');
            $table->dropColumn('noti_sms_sd_dt');
            $table->dropColumn('noti_sms_rc_no');
            $table->dropColumn('noti_kakao_sd_dt');
            $table->dropColumn('noti_kakao_rc_no');
            $table->dropColumn('donor_signature');
        });
    }

}
