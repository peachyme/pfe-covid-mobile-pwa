<?php

namespace App\Console;

use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use App\Notifications\CovidCaseNotification;
use App\Notifications\ProtocoleNotification;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function ()
        {
            $users = User::all();
    
            foreach ($users as $user) {
                $user->notify(new CovidCaseNotification($user));
            }
        })->everyMinute();
        // ->dailyAt('16:00');

        // $schedule->call(function ()
        // {
        //     $users = User::all();
    
        //     foreach ($users as $user) {
        //         $user->notify(new ProtocoleNotification($user));
        //     }
        // })->everyMinute();
        // // ->dailyAt('16:00');


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
