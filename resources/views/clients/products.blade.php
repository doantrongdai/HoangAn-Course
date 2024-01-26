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

{{-- @section('sidebar')
    @parent
    <h3>Products sidebar</h3>
@endsection --}}


@section('content')
    <h1>San pham</h1>
@endsection

@push('scripts')
    <script>
        console.log('Push lan 2')
    </script>
@endpush

@section('css')

@endsection

@section('js')
@endsection

@push('scripts')
    <script>
        console.log('Push lan 1')
    </script>
@endpush
