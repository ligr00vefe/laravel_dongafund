<?php

namespace App\Boards;

use App\Uploads\NewsAttachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class Boards
{
    protected string $table;
    protected array $columns, $where, $attachments;
    protected bool $result;
    protected int $paging = 15;
    protected $attachmentTable;
    protected int $adminDeleteLevel = 10;
    protected int $offset;
    protected array $notIn = [];
    private int $id;


    // 대량할당 방지
    private array $continue = [
        "id", "user_id", "like", "bad", "hits", "last_ip", "created_at", "updated_at"
    ];

    public function getId()
    {
        return $this->id;
    }

    public function paginate($request) : object
    {
        $category = $request->input("category") ?? false;
        $keyword = $request->input("term") ?? false;
        $page = $request->input("page") ?? 1;
        $offset = $this->offset ?? false;

        $query = DB::table($this->table)
        ->when($category, function ($query, $category) {
            return $query->where("category", "like", "%{$category}%");
        })
        ->when($keyword, function ($query, $keyword) {
            return $query->whereRaw("(title like ? or contents like ? or subtitle like ?)", [ "%{$keyword}%", "%{$keyword}%", "%{$keyword}%"]);
        })
        ;

        $return = new \stdClass();

        $return->paging = $query->count();

        if (count($this->notIn) > 0) {
            $query->whereNotin("id", $this->notIn);
        }

        $return->lists = $query->orderByDesc("id")->paginate($this->paging) ?? false;

        return $return;
    }

    public function insert($request) : int
    {
        $params = [];
        foreach ($this->columns as $column)
        {
            $params[$column] = $request->input($column) ?? null;
        }

        $thumbnail_id = $this->attachmentTable->set($request);

        $params["user_id"] = Auth::id() ?? 1;
        $params["thumbnail"] = $thumbnail_id['thumbnail'] ?? null;
        $params["attachment1"] = $thumbnail_id['attachment1'] ?? null;
        $params["attachment2"] = $thumbnail_id['attachment2'] ?? null;
        $params["attachment3"] = $thumbnail_id['attachment3'] ?? null;
        $params["attachment4"] = $thumbnail_id['attachment4'] ?? null;


        $this->id = DB::table($this->table)
            ->insertGetId($params);

        return $this->id;
    }

    public function update($request) : int
    {
        $this->id = (int) $request->input("id");
        $params = [];
        foreach ($this->columns as $column) {
            if (in_array($column, $this->continue)) continue;
            if (!$request->input($column)) continue;
            $params[$column] = $request->input($column);
        }

        $thumbnail_id = $this->attachmentTable->set($request);

        if($thumbnail_id){
            if (array_key_exists('thumbnail', $thumbnail_id)) {
                $params['thumbnail'] = $thumbnail_id['thumbnail'];
            }
            if (array_key_exists('attachment1', $thumbnail_id)) {
                $params['attachment1'] = $thumbnail_id['attachment1'];
            }
            if (array_key_exists('attachment2', $thumbnail_id)) {
                $params['attachment2'] = $thumbnail_id['attachment2'];
            }
            if (array_key_exists('attachment3', $thumbnail_id)) {
                $params['attachment3'] = $thumbnail_id['attachment3'];
            }
            if (array_key_exists('attachment4', $thumbnail_id)) {
                $params['attachment4'] = $thumbnail_id['attachment4'];
            }
        }



        $this->result = DB::table($this->table)
            ->where("id", $this->id)
            ->update($params);

        return $this->result ? $this->id : 0;
    }

    public function updateOrInsert(Request $request) : bool
    {
        $where = [];
        $params = [];

        foreach ($this->where as $find) {
            if (!$request->input($find)) continue;
            $where[$find] = $request->input($find);
        }

        foreach ($this->columns as $column) {
            if (in_array($column, $this->continue)) continue;
            if (!$request->input($column)) continue;
            $params[$column] = $request->input($column);
        }

        $this->result = DB::table($this->table)
            ->updateOrInsert(
                $where,
                $params
            );

        return $this->result;
    }

    public function delete($id)
    {
        $this->result = DB::table($this->table)
            ->where("id", $id)
            ->delete();

        return $this->result;
    }

    public function adminDelete($id) : bool
    {
        $user_id = Auth::id() ?? 1;

        $level = DB::table("users")
            ->where("id", $user_id)
            ->first()->level ?? false;

        if (!$level) return false;
        if ($this->adminDeleteLevel > $level) return false;

        $this->result = DB::table($this->table)
            ->where("id", $id)
            ->delete();

        return $this->result;
    }



}
