<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Orchestra\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \Elesen\Application\Commands\UpdateExpiredLicense::class,
        \Elesen\Application\Commands\ExpiredEmailNotification::class,

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('license:update-expired')->daily();
        $schedule->command('license:email-expired')->daily();

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
