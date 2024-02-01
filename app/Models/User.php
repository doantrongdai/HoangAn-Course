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
    }



    public function updateUser($data, $id)
    {
        // $data = array_merge($data, [$id]); -> Sửa thành code dưới gọn hơn
        $data[] = $id;
        // Cần có một khoảng trắng sau 'UPDATE' và trước 'SET' trong câu lệnh SQL của bạn. Nếu không có những khoảng trắng này, tên bảng sẽ dính liền với các từ khóa SQL, dẫn đến lỗi cú pháp SQL.
        return DB::update('UPDATE ' . $this->table . ' SET fullname=?, email=?,update_at=? where id = ?', $data);
    }
}
