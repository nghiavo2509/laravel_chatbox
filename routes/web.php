<?php

use App\Events\ChatEvent;
use App\Events\MessagePushed;
use App\Events\SendMail;
use App\Http\Controllers\ChatRealTimeController;
use App\Http\Controllers\HomeController;
use App\Jobs\MailJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layout');
});



Route::get('/home', function () {
    return  view('homepage');
});

Route::post('/home', function () {
    $text = request()->input('contents');
    event(new MessagePushed($text));
    return redirect()->back();
});

Route::get('/comment',function(Request $request){
    event(new ChatEvent($request->all('message')));
    return [
        'status'=>true
    ];
})->name('comment');


Route::get('/mail',[HomeController::class,'sendmail'])->name('sendMail');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/**
 * Chat Realtime with Sockio
 */
Route::middleware(['auth'])->group(function () {
    Route::get('/realtime',[ChatRealTimeController::class,'home'])->name('homeChat');
    Route::get('/chat',[ChatRealTimeController::class,'index'])->name('homeMessage');
    Route::post('/chat',[ChatRealTimeController::class,'sendMessage'])->name('sendMessage');
    Route::post('/statusOnline/{user}',[ChatRealTimeController::class,'statusOnline'])->name('statusOnline');
    Route::post('/statusOff/{user}',[ChatRealTimeController::class,'statusOff'])->name('statusOff');


});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
