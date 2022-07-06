<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\User;
use App\Jobs\SendReminderMailJob;


class Kernel extends ConsoleKernel
{
    /**
     * The artisan command provided by your application
     * 
     * @var array
     * 
     */
    protected $commands=[
        Commands\FileCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $user=User::inRandomOrder()->first();
        $schedule->job(new SendReminderMailJob($user))->everyMinute();


        // $schedule->command('file:cron')->everyMinute();
        
        $schedule->command("queue:work --stop-when-empty")->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
