<?php

use Illuminate\Support\Facades\Route;
use App\Mail\SendMarkdownMail;
use App\Jobs\SendReminderMailJob;
use App\Models\User;
use App\Events\SomeOneCheckedProfile;
use App\Jobs\Smtpjob;


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

Route::get('test-mail', function()
{

    //this below function will create one record in DB
    // dispatch(new SendReminderMailJob())->delay(now()->addSeconds(3));

    // or can use this too
    $user=User::findOrFail(1); 
    SendReminderMailJob::dispatch($user)->delay(now()->addSeconds(3));

    echo "Reminder Mail Sent";
    
});






































//below function is to run the queuq task without job entry in DB
    // dispatch(function()
    // {
    //     Mail::to('letsmailsameer@gmail.com')
    //     ->send(new SendMarkdownMail());

    // })->delay(now()->addSeconds(2));