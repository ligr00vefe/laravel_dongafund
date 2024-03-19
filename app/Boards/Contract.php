<?php


namespace App\Boards;


use App\Uploads\ContractAttachment;
use Illuminate\Support\Facades\Request;

class Contract extends Boards
{
    // 테이블명, 필수
    protected string $table = "board_contract";

    // 프론트->백으로 넘어올 input name값. 반드시 디비의 컬럼명과 동일해야함, 필수
    // 여기에 정의 안되면 디비에 안들어감
    protected array $columns = [
        "title", "attachment1","thumbnail", "from_date", "space1", "space2", "space3"
    ];

    // updateOrInsert 사용시 찾기 컬럼 정의하는 부분. 발전기금에선 사용안함
    protected array $where = [];

    // 한 페이지에 게시글 몇개가져올지 정의하기. 디폴트 15개
//    if()
    protected int $paging = 15;

    // 첨부파일이 있을 시 첨부파일 컬럼의 이름 (반드시 input의 name과 동일해야함)
    protected array $attachments = [ "attachment1, thumbnail" ];

    // 리턴 받을 때 사용하는 값
    protected bool $result;

    // 관리자 글 삭제시 회원의 필요 레벨
    protected int $adminDeleteLevel = 10;


    public function setPaging($paging)
    {
        $this->paging = $paging;
    }

    // 페이징
    public function get($request) : object
    {
        return $this->paginate($request);
    }

    // 글 쓰기
    public function write($request) : int
    {
        $this->attachmentTable = new ContractAttachment();
        $this->insert($request);
        return $this->getId();
    }

    // 글 수정
    public function update($request) : int
    {
        $this->attachmentTable = new ContractAttachment();
        parent::update($request);
        return $this->getId();
    }

    // 관리자 글 삭제
    public function adminDelete($id) : bool
    {
        return parent::adminDelete($id) ?? false;
    }

}

