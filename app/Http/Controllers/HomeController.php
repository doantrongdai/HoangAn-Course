<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ProductRequest;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public $data = [];
    public function index()
    {
        $this->data['title'] = 'Dao tao lap trinh Web';

        $this->data['message'] = 'Đăng ký tài khoản thành công';

        $user = DB::select('SELECT * FROM user ');
        dd($user);

        return "Unicode";

        // return view('clients.home', $this->data);

        // $this->data['welcome'] = 'Hoc lap trinh Laravel tai <b>Unicode</b>';
        // $this->data['content'] = '<h3>Chuong 1: Nhap mon Laravel</h3>
        // <p>Kien thuc 1</p>
        // <p>Kien thuc 2</p>
        // <p>Kien thuc 3</p>';
        // $this->data['index'] = 1;
        // $this->data['dataArr'] = [
        // 'Item 1',
        // 'Item 2',
        // 'Item 3'
        // ];
        // $this->data['number'] = 9;
        // return view('home', $this->data);
    }

    public function products()
    {
        $this->data['title'] = 'Sản phẩm';
        return view('clients.products', $this->data);
    }

    public function getAdd()
    {
        $this->data['title'] = 'Thêm sản phẩm';
        $this->data['errorMessage'] = "Vui lòng kiểm tra lại dữ liệu nhập vào";
        return view('clients.add', $this->data);
    }

    // public function postAdd(ProductRequest $request)
    // {
    //     dd($request->all());
    // $rules = [
    // 2 validate: cần required và min 6 ký tự
    // 'product_name' => 'required|min:6', 
    // 'product_price' => 'required|integer'
    // ];

    // $messages =   [
    //     'product_name.required' => 'Tên sản phẩm bắt buộc phải nhập',
    //     'product_name.min' => 'Tên sản phẩm không được nhỏ hơn :min ký tự',
    //     'product_price.required' => 'Giá sản phẩm bắt buộc phải nhập',
    //     'product_price.min' => 'Giá sản phẩm phai la so',
    // ];
    // $request->validate($rules, $messages);
    // }


    public function postAdd(Request $request)
    {
        $rules = [
            'product_name' => ['required', 'min:6', function ($attributes, $value, $fail) {
                isUppercase($value, 'Trường :attribute chưa viết hoa', $fail);
            }],
            'product_price' => ['required', 'integer']
        ];

        // $messages = [
        //     'product_name.required' => 'Tên sản phẩm bắt buộc phải nhập',
        //     'product_name.min' => 'Tên sản phẩm  không được nhỏ hơn :min ký tự',
        //     'product_price.required' => 'Giá sản phẩm bắt buộc phải nhập',
        //     'product_price.min' => 'Giá sản phẩm phải là số',
        // ];
        $messages = [
            'required' => ':attribute bắt buộc phải nhập',
            'min' => ':attribute không được nhỏ hơn :min ký tự',
            'integer' => ':attribute phải là số',
        ];

        $attributes = [
            'product_name' => 'Tên sản phẩm',
            'product_price' => 'Giá sản phẩm'
        ];

        // Validator::make($inputs, $rules, $messages, $attributes);
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        // if ($validator->fails()) {
        //     return 'Validate that bai';
        // } else {
        //     return 'Validate thanh cong';
        // }
        $validator->validate();
    }

    public function putAdd(Request $request)
    {
        dd($request);
    }

    public function getArr()
    {
        $contentArr = [
            'name' => 'Laravel 8.x',
            'lesson' => 'Khoá học lập trình Laravel',
            'academy' => 'Unicode Academy'
        ];
        return $contentArr;
    }
    public function downloadImage(Request $request)
    {
        if (!empty($request->image)) {
            $image = trim($request->image); // Loại bỏ các khoảng cách thừa của biến
            // uinqid()  hàm PHP được sử dụng để tạo ra một chuỗi đặc biệt định danh duy nhất
            // $fileName = 'image_' . uniqid() . '.jpg';
            $fileName = basename($image);
            // return response()->streamDownload(function ()  use ($image) {
            //     $imageContent = file_get_contents($image);
            //     echo $imageContent;
            // }, $fileName);

            return response()->download($image);
        }
    }

    public function downloadDoc(Request $request)
    {
        if (!empty($request->file)) {
            $file = trim($request->file); // Loại bỏ các khoảng cách thừa của biến
            // uinqid()  hàm PHP được sử dụng để tạo ra một chuỗi đặc biệt định danh duy nhất
            // $fileName = 'image_' . uniqid() . '.jpg';
            $fileName = 'tai-lieu_' . uniqid() . '.pdf';
            // return response()->streamDownload(function ()  use ($image) {
            //     $imageContent = file_get_contents($image);
            //     echo $imageContent;
            // }, $fileName);
            $headers = [
                'Content-Type' => 'application/pdf'
            ];

            return response()->download($file, $fileName, $headers);
        }
    }
}
