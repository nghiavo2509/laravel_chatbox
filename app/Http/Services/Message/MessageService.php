<?php

namespace App\Http\Services\Message;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PO;

class MessageService{

    /**
     * Trạng thái online/offlice của user
     *  user_to :   client 2
     *  user_from : your id  1
     * liệt kê tn mình gửi : from : 1 , to : 2
     * liệt kê tin nhắn client gửi : to : 1 , from :2
     */
    public function statusOnline($id){
        $data = [];
        $user = User::find($id);
        $user->online = 1;
        $user->save();
        $data['id'] =$user->id ;
        $data['name'] =$user->name ;
        return $data;
    }
    public function statusOff($id){
        $data = [];
        $user = User::find($id);
        $user->online = 0;
        $user->save();
        $data['id'] =$user->id ;
        $data['name'] =$user->name ;
        return $data;
    }
    
    /**
     *  Show lịch sử nhắn tin của 2 user
     */
    public function getMessage($id){
            $message = Message::where('user_to',$id)
            ->where('user_from',auth()->user()->id)
            ->orWhere('user_to',auth()->user()->id)
            ->Where('user_from',$id)
            ->get();
            if($message->isEmpty()){
                return false;
            }
            return $message;
        
    }


    public function getUserListChat(){
        $user = User::whereNotIn('id',[auth()->user()->id])->with('getMessage')->get();
        return $user->except(auth()->user()->id);
    }

    /**
     * Lấy tin nhắn mới nhất show ra ở cột trái user
     */
    public function getMessageNewest($user_to){
        $message = Message::where(['user_from'=>auth()->user()->id ,'user_to'=>$user_to])->orderBy('id','desc')->first();
        return $message;
    }

    /**
     * Lưu tin nhắn chat vào db
     */
    public function store($request){
        $user_to = $request->input('user_to') ;
        $user_from = Auth::user()->id;
        $message = $request->input('message');
        return Message::create([
            'message'=>$message,
            'user_to'=> $user_to,
            'user_from'=> $user_from,
        ]);
    }
}