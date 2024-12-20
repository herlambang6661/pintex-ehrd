<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected $commands = [
        Commands\ScheduleLegalitas::class,
        Commands\ScheduleKomunikasi::class,
        Commands\ScheduleUpdateDataCuti::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('komunikasi:cron')->dailyAt('01:00')->timezone('Asia/Jakarta');
        $schedule->command('datacuti:cron')->dailyAt('03:00')->timezone('Asia/Jakarta');
        $schedule->command('legalitas:cron')->dailyAt('05:00')->timezone('Asia/Jakarta');
        $schedule->command('cache: clear')->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
