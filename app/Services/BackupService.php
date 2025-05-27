<?php

namespace App\Services;

use Illuminate\Support\Facades\Artisan;

class BackupService
{
    public function createBackupDatabase()
    {
        try {
            Artisan::call('db:backup');
        }
        catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function restoreDatabase($filename)
    {
        try {
            Artisan::call('db:restore ' . $filename);
        }
        catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
