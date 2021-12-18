
<div class="mesgs">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="head-mess">
        <a href="{{  route('homeMessage') }}"> <i class="fa fa-arrow-circle-left"> Back</i>
        </a>
    </div>
    <div class="msg_history">
        @if(isset($messages) && $messages)
            @foreach ($messages as $message )
                {{-- Client --}}
                @if ($message->user_from != auth()->user()->id)
                    <div class="incoming_msg">
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                            <p>{{$message->message}}</p>
                            <span class="time_date"> {{ $message->created_at->format('h:s | M d') }}</span></div>
                        </div>
                    </div>
                @else
                {{-- your --}}
                    <div class="outgoing_msg">
                        <div class="sent_msg">
                            <p>{{$message->message}}</p>
                            <span class="time_date"> {{ $message->created_at->format('h:s | M d') }}</span> 
                        </div>
                    </div>
                @endif
            @endforeach
        @else
        <div class="notthing" style="text-align: center;">
            <h4 class="text-center">{{ $chatWith->name }}</h4>
            <img style="width: 80px;height: 80px;" src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
            <p style="margin: 10px;"><i>  Lịch sử trò chuyện (Trống) </i></p>
        </div>
        @endif
    </div>
    {{-- Input - Button --}}
    <div class="type_msg">
        <div class="input_msg_write">
            <form class="form" action="{{ route('sendMessage') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" class="ip_userTo" name="user_to" value="{{ app('request')->id }}" >
                <input type="text" id="message" class="write_msg" name="message" placeholder="Type a message" />
                <button id="send" class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
            </form>
        </div>
    </div>
</div>