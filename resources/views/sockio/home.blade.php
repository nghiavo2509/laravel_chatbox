@extends('sockio.layout')
@section('content')   
<div class="container">
    <h3 class=" text-center" style="padding: 50px 0 30px 0;">Ứng dụng Chat Thời gian thực</h3>
    <div class="messaging">
        <div class="inbox_msg">
            {{-- Left List User --}}
            @include('sockio.inc.left-user')

            {{-- Right Message --}}
            <div class="msg_history">
            <h3 style="text-align: center;">Chào mừng bạn đến với Project Của tôi.</h3>
                <i>Write by <strong>NghiaVo</strong></i>
            <h4 class="text-center"> Đây là ứng dụng Chat RealTime </h4> 
            <ul>
                <li><p> Được viết bằng FrameWork PHP Laravel </p> </li>
                <li> <p> Các công nghệ tôi đã sử dụng: Sockio, Redis, Predis,BoardCast</p></li>
            </ul>
        </div>
        </div>
          <p class="text-center top_spac"> Design by <a target="_blank" href="https://www.linkedin.com/in/sunil-rajput-nattho-singh/">NghiaVo</a></p>
    </div>
</div>

@endsection
