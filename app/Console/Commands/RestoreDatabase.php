<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RestoreDatabase extends Command
{
    protected $signature = 'db:restore {filename}';
    protected $description = 'Restore the database from a backup file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $backupPath = storage_path('app\\backups');
        $backupFile = $backupPath . '\\' . $this->argument('filename');

        if (!file_exists($backupFile)) {
            $this->error('Backup file not found: ' . $backupFile);
            return;
        }

        $command = env('DB_MYSQLDUMP_PATH') . "mysql" .
            " -u " . env('DB_USERNAME') . " " .
            env('DB_DATABASE') . " < " . $backupFile;

        exec($command);

        $this->info('Database restored from backup: ' . $backupFile);
    }
}
