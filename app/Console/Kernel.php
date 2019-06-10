<?php

namespace App\Console;

use App\Jobs\DailyTransactionImportJob;
use DateTime;
use Exception;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     * @throws Exception
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule
            ->job(new DailyTransactionImportJob(new DateTime("yesterday")))
            ->timezone("Europe/Berlin")
            ->dailyAt("02:00");
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
