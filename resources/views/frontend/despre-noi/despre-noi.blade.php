@extends('main.app')

@section('content')
<div class="container-despre-noi">
    <div class="wrapper-imagine">
        <img src="/files/{!!$imagine!!}" alt="" srcset="">
    </div>
    {!! $about_us->continut !!}
</div>

@endsection
