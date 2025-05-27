<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BackupDatabase extends Command
{
    protected $signature = 'db:backup';
    protected $description = 'Create a backup of the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $currentDateTime = Carbon::now()->format('Y-m-d_H-i-s');
        $filename = "backup_" . $currentDateTime . ".sql";

        $command = env('DB_MYSQLDUMP_PATH') . "mysqldump" .
            " -u " . env('DB_USERNAME') . " " .
            env('DB_DATABASE') . " > " . storage_path() . "/app/backups/" . $filename;

        exec($command);
    }
}
