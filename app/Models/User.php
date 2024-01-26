<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    use HasFactory;

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
}
