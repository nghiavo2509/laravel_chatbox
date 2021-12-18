<div class="inbox_people">
    <div class="headind_srch">
        <div class="recent_heading">
            <div class="your_user">
                <img src="https://ptetutorials.com/images/user-profile.png" alt="Avatar">
                <strong> {{ auth()->user()->name}} </strong>
                <input type="hidden" class="your_id" value="{{ auth()->user()->id }}">
            </div>
        </div>
        <div class="srch_bar">
        <div class="stylish-input-group">
            <input type="text" class="search-bar"  placeholder="Search" >
            <span class="input-group-addon">
            <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
            </span> </div>
        </div>
    </div>
    <div class="inbox_chat">
        <div class="chat_list active_chat">  
            @foreach ($users as $user )
            <?php  
                $messageNewest = \App\Http\Services\Message\MessageService::getMessageNewest($user->id);
            ?>
            <div class="chat_people">
                <span class="checkonline useronline-{{ $user->id }} {{ $user->online == 1 ? "active" : ""  }}" > </span>
                <a href="{{ route('homeMessage',[ 'id' => $user->id ] )  }}">
                    <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                    <div class="chat_ib">
                        {{-- format('h:i | M d') --}}
                        <h5>{{ $user->name }} <span class="chat_date"> {{ $messageNewest != null ? $messageNewest->created_at->format('h:i | M d') : ''}} </span></h5>
                        <p>{{  $messageNewest != null ? Str::limit($messageNewest->message, 30, ' ...') : 'Message not found ...'}}</p>
                    </div>
                </a>
            </div>
            @endforeach
           

        </div>
    </div>
    <div class="">
        <form action="{{ route('logout') }}" method="post">
            {{ csrf_field() }}
            <button class="logout">Đăng xuất</button>
        </form>
    </div>
</div>