<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\USer;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class UserController extends Controller
{
    // Thêm hàm khởi tạo __construct để áp dụng cho tất cả function trong class
    private $user;
    public function __construct()
    {
        $this->user = new User();
    }

    // 
    public function index()
    {
        $title = 'Danh sách người dùng';
        $userList = $this->user->getAllUser();
        return view('clients.user.lists', compact('title', 'userList'));
    }


    public function add()
    {
        $title = "Thêm người dùng";
        return view('clients.user.add', compact('title'));
    }

    public function postAdd(Request $request)
    {
        $request->validate([
            'fullname' => 'required|min:5',
            'email' => 'required|email|unique:user'
        ], [
            'fullname.required' => 'Họ và tên bắt buộc phải nhập',
            'fullname.min' => 'Họ và tên phải từ 5 ký tự trở lên',
            'email.required' => 'Email bắt buộc phải nhập',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại trên hệ thống',
        ]);

        $dataInsert = [
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s')
        ];

        $this->user->addUser($dataInsert);
        return redirect()->route('user.index')->with('msg', 'Thêm người dùng thành công');
    }

    public function getEdit($id = 0)
    {
    }
}
