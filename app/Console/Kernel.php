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
	\Elesen\Model\Commands\MigrateUserBusinessInfo::class,
	\Elesen\Model\Commands\MigrateAdsKekalLicense::class,
	\Elesen\Model\Commands\MigrateAdsSementaraLicense::class,
	\Elesen\Model\Commands\MigrateBusinessLicense::class,
	\Elesen\Model\Commands\MigrateCarparkLicense::class,
	\Elesen\Model\Commands\MigratePenjajaSementaraLicense::class,
	\Elesen\Model\Commands\MigratePenjajaStatikLicense::class,
	\Elesen\Model\Commands\MigrateUserAdvertisementInfo::class,
	\Elesen\Model\Commands\MigrateUserHawkerInfo::class,
        \Elesen\Model\Commands\UpdateCounterPayment::class,
	\Elesen\Model\Commands\SeedPremiseDefault::class,
	\Threef\Entree\Console\ConfigEmailAccount::class,
        \Threef\Entree\Console\ExpireryEmailAccount::class,
	\Elesen\Model\Commands\ExpiredLicense::class,
	\Elesen\Model\Commands\MigrateAdsKekalPl::class,
	\Elesen\Model\Commands\ExpiredCounterPayment::class,
	\Elesen\Model\Commands\RunningNoReset::class,
	\Elesen\Model\Commands\ExpiredPaymentLicense::class,
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
        //$schedule->command('license:update-expired')->daily();

        $schedule->command('license:email-expired')->daily(); //turn off by temporary
	//$schedule->command('payment:update-counter')->everyMinute();
	//$schedule->command('threef:email-notify')->daily();
	$schedule->command('backup:clean')->daily()->at('01:00');
        $schedule->command('backup:run --only-files')->daily()->at('02:00');
	$schedule->command('license:expired-list-email')->daily()->at('03:00');
	$schedule->command('counter:update-expired')->daily()->at('04:00');	
	$schedule->command('runningno:reset')->cron('* * 1 1 *'); //reseting running no every year at 1 jan
	$schedule->command('payment:clear-expired')->daily()->at('00:30'); // change status license to 16 selepas 14 hari dari created_at jika tak bayar 
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
