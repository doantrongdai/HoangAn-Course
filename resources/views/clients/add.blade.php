@extends('layouts.client')

@section('title')
    {{ $title }}
@endsection



@section('content')
    <h1>Thêm sản phẩm</h1>
    {{--$errors->any(): nếu có bất kì lỗi nào trong tất cả các error sẽ trả về thông báo error đó  --}}
    
    <form action="" method="POST" id="product-form">
        {{-- @if ($errors->any())
        <div class="alert alert-danger text=center">
            {{$errorMessage}}
        </div>     
        @endif --}}

        @error('msg')
            <div class= "alert alert-danger text-center">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="">Tên sản phẩm</label>
            <input type="text" class="form-control" name="product_name" placeholder="Tên sản phẩm....">
        @error('product_name')
            <span style="color: red">{{ $message }}</span> 
        @enderror
        
        </div>

        <div class="mb-3">
            <label for="">Giá sản phẩm</label>
            <input type="text" class="form-control" name="product_price" placeholder="Giá sản phẩm....">
            @error('product_price')
            <span style="color: red">{{ $message }}</span> 
        @enderror
        </div>

        <button type="submit" class="btn btn-primary">Thêm mới</button>
        @csrf
        {{-- @method('PUT') --}}
    </form>
@endsection

@section('css')

@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('#product-form').on('submit', function(e){
                e.preventDefault();
                alert('ok');
            })
        });
    </script>

@endsection