<?php

namespace App\Http\Controllers;

use App\Jobs\MailJob;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }
    public function index()
    {
        return view('home');
    }
    public function sendmail(){
        $user = User::find(1);
        dispatch(new MailJob($user));
        return 'gửi mail thanh cong';

    }
}
