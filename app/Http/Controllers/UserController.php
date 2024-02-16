<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\USer;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class UserController extends Controller
{
    //Hàm khởi tạo __construct sẽ áp dụng cho tất cả function trong class
    //$this->user: Được sử dụng để giữ một đối tượng của lớp User trong phạm vi của đối tượng UserController.
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // 
    public function index()
    {
        // $statement = $this->user->statementUser("DELETE FROM user");
        // dd($statement);

        $title = 'Danh sách người dùng';

        $this->user->learnQueryBuilder();

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


    //Phương thức ->with được sử dụng để chuyển dữ liệu (thông thường là các biến hoặc thông báo) đến chế độ xem
    public function getEdit(request $request, $id = 0)
    {
        $title = "Cập nhật người dùng";

        if (!empty($id)) {
            $userDetail = $this->user->getDetail($id);
            if (!empty($userDetail[0])) {
                $request->session()->put('id', $id);
                $userDetail = $userDetail[0];
            } else {
                return redirect()->route('user.index')->with('msg', 'Người dùng không tồn tại');
            }
        } else {
            return redirect()->route('user.index')->with('msg', 'Liên kết không tồn tại');
        }
        return view('clients.user.edit', compact('title', 'userDetail'));
    }


    // Xử lý validate
    public function postEdit(Request $request)
    {
        $id = session('id');
        if (empty($id)) {
            return back()->with('msg', 'ID không tồn tại');
        }
        $request->validate([
            'fullname' => 'required|min:5',
            // Cần thêm $id, nếu không có hệ thống check validate khi cập nhật lúc nào cũng luôn có mail đó trên hệ thống rồi.
            'email' => 'required|email|unique:user,email,' . $id
        ], [
            'fullname.required' => 'Họ và tên bắt buộc phải nhập',
            'fullname.min' => 'Họ và tên phải từ 5 ký tự trở lên',
            'email.required' => 'Email bắt buộc phải nhập',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại trên hệ thống',
        ]);



        $dataUpdate = [
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s')
        ];
        $this->user->updateUser($dataUpdate, $id);

        // return redirect()->route('user.edit',['id'=>$id])->with('Cập nhật người dùng thành công');

        return back()->with('msg', 'Cập nhật người dùng thành công');
    }

    public function delete($id = 0)
    {
        // Kiểm tra xem có tồn tại người dùng đó không???
        if (!empty($id)) {
            $userDetail = $this->user->getDetail($id);
            if (!empty($userDetail[0])) {
                $deleteStatus = $this->user->deleteUser($id);
                if ($deleteStatus) {
                    $msg = 'Xoá người dùng thành công';
                } else {
                    $msg = 'Bạn không thể xoá người dùng lúc này';
                }
            } else {
                $msg = 'Người dùng không tồn tại';
            }
        } else {
            $msg = 'Liên kết không tồn tại';
        }

        return redirect()->route('user.index')->with('msg', $msg);
    }
}
