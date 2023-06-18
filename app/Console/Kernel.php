<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // taking backup of database every day and deleting old backups
        // just run php artisan schedule:work
        $schedule->call(function () {
            Artisan::call('backup:run --only-db');
            $this->deleteOldBackups();
        })->daily();
    } // end of schedule

    private function deleteOldBackups()
    {
        $backups = Storage::disk('local')->allFiles(env('APP_NAME'));
        // delete all backups except the last two
        if (count($backups) > 2) {
            foreach ($backups as $key => $backup) {
                if ($key < count($backups) - 2) {
                    Storage::disk('local')->delete($backup);
                }
            }
        }
    } // end of deleteOldBackups

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
