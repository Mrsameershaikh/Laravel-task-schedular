<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMarkdownMail;
use App\Models\User;
use Illuminate\Mail\Transport\SesTransport;

class SendReminderMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public User $user;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
        $this->user=$user;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       
        // Mail::to($this->user->email)
        // ->send(new SendMarkdownMail($this->user));
        try{
        $message_id="";
        Mail::send('emails.attendancereminder',array(),function($message) use (&$message_id){
        $message_id=$message->getId();
        $message->to($this->user->email,'Sameer')->subject('check id');
      });
       echo $message_id." ";
      }


      catch(\Swift_TransportException $transportExp){
        $mailtrapMessage=$transportExp->getMessage();
        echo $mailtrapMessage;
      }

      
      catch(Swift_RfcComplianceException $e){
        $gmailMessage=$e->getMessage();
        echo $gmailMessage;
      }







    //     $message_id="";
    //     Mail::send('emails.thanks',array(),function($message) use (&$message_id){
    //     $message_id=$message->getId();
    //     $message->to('letsmailsameer@gmail.com','Sameer')->subject('check id');
    //   });
    //   echo $message_id;
        
    }
}
