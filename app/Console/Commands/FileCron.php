<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use PDF;

class FileCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'file:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
       $data["title"]="PDF file from CronJob";
       $data["email"]="letsmailsameer@gmail.com";
       $data["body"]="The PDF file attached to this email kindly check";

        $pdf=PDF::loadView('view',$data);

        Mail::send('view',$data, function($message) use ($data, $pdf){
            $message->to($data["email"])->subject($data["title"])->attachData($pdf->output(),"test.pdf");
        }); 
    }
}
