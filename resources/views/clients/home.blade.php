{{-- <h1>Trang chu Unicode</h1> --}}
{{-- 2 dấu ngoặc nhọn sẽ chuyển tất cả sang thành dạng thực thể --}}
{{-- <h2>{{!empty(request()->keyword)?request()->keyword: 'Khong co gi'}}</h2>
<div class="container">  --}}
{{-- 1 dấu {!!$ !!} => giúp biên dịch HTML  --}}
{{-- Toán tử 3 ngôi, nếu ko tồn tại $content => $content:false --}}
    {{-- {!! !empty($content)?$content:false !!}
</div> --}}
{{-- <h2>{{ $welcome }}</h2> --}}

{{-- <hr> --}}

{{-- @for ($i = 1; $i <= 10; $i++)
<p>Phan tu thu : {{ $i }}</p>  
@endfor --}}

{{-- @foreach ($dataArr as $key => $item)
    <p>Phan tu: {{ $item }} - {{ $key }}</p>
@endforeach --}}

{{-- @forelse ($dataArr as $item)
    <p>Phan tu: {{ $item }}</p>
@empty
    <p>Khong co phan tu nao</p>
@endforelse --}}

{{-- @if ($number>=10)
    <p>Day la gia tri hop le</p>
    
@else
    <p>Gia tri ko hop le</p>
@endif

<script>
    hello , @{{ name }};
</script> --}}

@extends('layouts.client')

@section('title')
    {{ $title }}
@endsection

@section('sidebar')
    @parent
    <h3>Home sidebar</h3>
@endsection


@section('content')
    <h1>Trang chủ</h1>
    {{-- @datetime('2023-09-10 16:05:30') --}}
    @include('clients.contents.slide')
    @include('clients.contents.about')

    @env('local')
    <p>Môi trường dev</p>
    @else
    <p>Không phải môi trương dev</p>
    @endenv
    {{-- <x-alert type="info" :content="$message" data-icon="youtube"/> --}}

    <p><img src="https://icdn.24h.com.vn/upload/3-2023/images/2023-09-13/Noi-bo-MU-ran-nut-Sancho-quyet-khong-da-cho-Ten-Hag-san-sang-du-bi-roi-ra-di-jadon-sancho-noi-gi-ve-an-phat-cua-ten-hag-084845j-1694590093-328-width740height493.jpg" alt=""></p>

    <p><a href="{{ route('download-image').'?image='.public_path('storage/168675067_3189781261124236_7840751220849405963_n.jpg')}}" class="btn btn-primary">Download picture</a></p> 

    <p><a href="{{ route('download-doc').'?file='.public_path('storage/demo.pdf')}}" class="btn btn-primary">Download document</a></p> 

    @endsection

@section('css')
<style>
    img{
        max-width: 100%;
        height: auto;
    }
</style>

@endsection

@section('js')

@endsection