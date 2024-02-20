@extends('layouts.client')

@section('title')
    {{ $title }}
@endsection

@section('content')
    {{-- Session msg thành công --}}
    @if (session('msg'))
    <div class="alert alert-success">{{ session('msg')}}</div> 
    @endif 

     {{-- Session msg error --}}
    @if ($errors->any())
        <div class="alert alert-success">Dữ liệu nhập vào không hợp lệ. Vui lòng kiểm tra lại</div>
    @endif

    <h1>{{ $title }}</h1>
    {{-- value ="old" -> Để lưu lại dữ liệu nhập trên giao diện --}}
    <form action="" method="POST">
        <div class="mb-3">
            <label for="">Họ và tên</label>
            <input type="text" class="form-control" name="fullname" placeholder="Họ và tên..." value="{{ old('fullname') }}"/>
            {{-- Xử lý validate --}}
            @error('fullname')
                 <span style="color: red;">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Email</label>
            <input type="text" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}"/>
            {{-- Xử lý validate --}}            
            @error('email')
                 <span style="color: red;">{{$message}}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Thêm mới</button>
        <a href="{{ route('user.index') }}" class="btn btn-warning">Quay lại</a>
        @csrf
    </form>

@endsection

