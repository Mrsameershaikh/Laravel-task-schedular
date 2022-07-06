<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendMail;
use Mail;



class MailController extends Controller
{
    public function sendEmail()
    {
        $details=[
            'title'=>'Titel:Mail from cronjobs team',
            'body'=>'Body:This is for testing using SMTP'
        ];

        Mail::to('letsmailsameer@gmail.com')->send(new SendMail($details))->delay(now()->addSeconds(10));
        return view('emails.thanks');
        

        
    }

}
