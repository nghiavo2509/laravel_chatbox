<?php 
use Illuminate\Support\Str;
?>

@extends('sockio.layout')
@section('content')   
<div class="container">
    <h3 class=" text-center" style="padding: 50px 0 30px 0;">Ứng dụng Chat Thời gian thực</h3>
    <div class="messaging">
        <div class="inbox_msg">
            {{-- Left List User --}}
            @include('sockio.inc.left-user')

            {{-- Right Message --}}
            @include('sockio.inc.right-message')
        </div>
          <p class="text-center top_spac"> Design by <a target="_blank" href="https://www.linkedin.com/in/sunil-rajput-nattho-singh/">NghiaVo</a></p>
    </div>
</div>
@endsection
