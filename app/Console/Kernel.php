<?php

namespace App\Console;

use App\Jobs\TUE_tsk;
use Illuminate\Console\Scheduling\Schedule;
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

        $schedule->command('hour:update')
            ->hourly()
            ->withoutOverlapping()
            ->sendOutputTo('storage/logs/tasksch.log');
        /*
        $schedule->job(new TUE_tsk)
            ->everyMinute()
            ->sendOutputTo('storage/logs/tasksch.log');
            */
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
