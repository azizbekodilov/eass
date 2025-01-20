<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call('App\Http\Controllers\TokenController@newToken')->weekdays()->everyMinute()->between('3:00', '23:59');
        $schedule->call('App\Http\Controllers\TokenController@send_data')->weekdays()->dailyAt('10:00');
        $schedule->call('App\Http\Controllers\TokenController@send_data_last_day')->weekdays()->dailyAt('09:20');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
