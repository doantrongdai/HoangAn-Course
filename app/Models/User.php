<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    use HasFactory;

    //Định nghĩa tên của bảng cơ sở dữ liệu mà class User sẽ tương tác
    protected $table = 'user';

    public function getAllUser()
    {
        $user = DB::select('SELECT * From user ORDER BY create_at DESC');
        return $user;
    }

    public function addUser($data)
    {
        DB::insert('INSERT INTO user (fullname, email, create_at) values(?,?,?)', $data);
    }


    public function getDetail($id)
    {
        return DB::select('SELECT * FROM ' . $this->table . '  WHERE id = ?', [$id]);
        dd($id);
    }



    public function updateUser($data, $id)
    {
        // $data = array_merge($data, [$id]); -> Sửa thành code dưới gọn hơn
        $data[] = $id;
        // Cần có một khoảng trắng sau 'UPDATE' và trước 'SET' trong câu lệnh SQL của bạn. Nếu không có những khoảng trắng này, tên bảng sẽ dính liền với các từ khóa SQL, dẫn đến lỗi cú pháp SQL.
        return DB::update('UPDATE ' . $this->table . ' SET fullname=?, email=?,update_at=? where id = ?', $data);
    }

    public function deleteUser($id)
    {
        return DB::delete('DELETE FROM ' . $this->table . ' WHERE id = ?', [$id]);
    }

    public function statementUser($sql)
    {
        return DB::statement($sql);
    }


    public function learnQueryBuilder()
    {
        DB::enableQueryLog();
        // Lấy tất cả bản ghi của table, fullname as ho ten-> định danh sang thành "ho ten"
        // $id = 8;
        $lists = DB::table($this->table)
            ->select('*')
            // ->where('id', 7)
            // ->where(function ($query) use ($id) {
            //     $query->where('id', '<', $id)->orwhere('id', '>', $id);
            // })
            // ->where('fullname', 'like', '%Dai%')
            // ->wherenotBetween('id', [8, 10])
            // ->whereIn('id', [8, 10])
            // ->whereNotNull('update_at')
            ->whereDate('update_at', '2024-02-16')
            ->get();
        // Lấy 1 bản ghi đầu tiên của table
        dd($lists);
        $sql = DB::getQueryLog();
        dd($sql);
        $detail = DB::table($this->table)->first();
    }
}
