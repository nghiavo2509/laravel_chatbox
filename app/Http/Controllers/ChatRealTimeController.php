<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Http\Services\Message\MessageService;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChatRealTimeController extends Controller
{
    protected $messageService;
    public function __construct(MessageService $message)
    {
        $this->messageService = $message;
    }
    public function home(){

        $users = $this->messageService->getUserListChat();
        return view('sockio.home',compact('users'));
    }
    

    public function index(Request $request){
        $getId = $request->id;
        $chatWith = User::find($getId);
        if( $chatWith != NULL){
            /**
             * Danh sách user will be show in left sidebar
             */
            $users = $this->messageService->getUserListChat();
            /**
             * Tin nhắn
             */
            $messages = $this->messageService->getMessage($getId);
            // if($messages){
                return view('sockio.chat',compact('messages','users','chatWith'));
            // }
            return redirect()->route('homeMessage',
            ['messages'=>$messages]);
        }
        return redirect()->route('homeChat');
    }


    public function sendMessage(Request $request){
        $request->validate([
            'message' => 'required',
        ]);
        $message = $this->messageService->store($request);
        event(new ChatEvent($message));
        return redirect()->back();
    }

    public function statusOnline($id){
        $result = $this->messageService->statusOnline($id);
        return response()->json($result,200);
    }
    public function statusOff($id){
        $result = $this->messageService->statusOff($id);

        return response()->json($result,200);

    }

}
