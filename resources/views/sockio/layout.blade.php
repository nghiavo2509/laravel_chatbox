
<!DOCTYPE html>
<html lang="en">
    {{-- Head --}}
@include('sockio.inc.head')
<body>

    {{-- Content --}}
    @yield('content')
  
{{-- Footer --}}
@include('sockio.inc.footer')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let yourId = $('.your_id').val();
        var socket = io('http://localhost:8888', {
            transports: ['websocket']
        });
    //  Submit
    $('.form').submit(function(e){
        e.preventDefault();    
        let input = $('#message').val();
        let id = $('.ip_userTo').val();
        let data = { user_to : id, message : input};
        /**
         * Truyền data lên server khi submit
         */
        socket.emit('laravel_database_chat:message', data);
    });
   
    // nhận dữ liệu từ server trả về
    socket.on('laravel_database_chat:message',function(data){
            let html = "";
            if(data.id == yourId){
                html += "<div class='incoming_msg' id='u-"+data.id+"'>"
                html += "<div class='incoming_msg_img'>";
                html += "<img src='https://ptetutorials.com/images/user-profile.png' alt='sunil'>";
                html += "</div>";
                html += "<div class='received_msg'>";
                html += "<div class='received_withd_msg'>";
                html += "<p> "+ data.message+ " </p>";
                html += "<span class='time_date'> 11:01 AM | June 9</span></div>";
                html += "</div>";
                html += "</div>" ;
                $('.msg_history').append(html);
            }else{
                html +="<div class='outgoing_msg'>";
                html +="<div class='sent_msg'>";
                html +="<p>"+ data.message+"</p>";
                html +="<span class='time_date'> </span> ";
                html +="</div>";
                html +="</div>";
                $('.msg_history').append(html);
            }

        });
       
        // Check When user Login :: 1
        // đẩy qua server
        socket.emit('checkOnline',{userId : yourId });
        // Nhận dữ liệu từ server chuyển qua :: 3

        socket.on("disconnectUser", (id) => {  
            $.ajax({
                url:'/laravel_chatbox/statusOff/'+id,
                method:"POST",
                dataType:"JSON"
            }).done(function(response){
                console.log('offlice');
                
                if(response && response.id != yourId ){
                    $('.useronline-'+response.id).removeClass('active');
                    $.notify(response.name +' Offlice', "warn");
                }
            });
        });
        socket.on('checkOnline',function(id){
                $.ajax({
                url:'/laravel_chatbox/statusOnline/'+id,
                method:"POST",
                dataType:"JSON"
                }).done(function(response){
                    console.log(response);
                    if(response && response.id != yourId ){
                        $('.useronline-'+response.id).addClass('active');
                        $.notify(response.name +' Online', "success");
                    }
                });
           
        });

    </script>
</body>
</html>