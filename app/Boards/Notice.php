<?php


namespace App\Boards;


use App\Uploads\NewsAttachment;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;

class Notice extends Boards
{
    protected string $table = "board_notice";
    protected array $columns = [ "category", "title", "subtitle", "contents", "editor_image", "attachment1", "thumbnail", "from_date", "space1", "space2" ];
    protected array $where = [];
    protected array $attachments = [ "thumbnail" ];
    protected bool $result;
    protected int $offset;
    protected int $adminDeleteLevel = 10;
    protected int $paging = 4;


    public function setExceptLastId()
    {
        $last_id = DB::table("baord")
            ->orderByDesc("id")
            ->limit(1)
            ->first()->id ?? false;

        if ($last_id) {
            $this->notIn = [ $last_id ];
        }
    }

    public function setNotIn($notIn)
    {
        $this->notIn = $notIn;
    }

    public function setPaging($paging)
    {
        $this->paging = $paging;
    }

    public function setOffset($offset)
    {
        $this->offset = $offset;
    }


    public function get($request) : object
    {
        return $this->paginate($request);
    }

    public function write($request) : int
    {
        $this->attachmentTable = new NewsAttachment();
        $this->insert($request);
        return $this->getId();
    }

    public function update($request) : int
    {
        $this->attachmentTable = new NewsAttachment();
        parent::update($request);
        return $this->getId();
    }

    public function adminDelete($id) : bool
    {
        return parent::adminDelete($id) ?? false;
    }


}
