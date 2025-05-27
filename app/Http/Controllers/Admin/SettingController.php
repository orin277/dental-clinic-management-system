<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BackupService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function __construct(private BackupService $backupService)
    {

    }

    public function index(Request $request) {
        $backupFiles = Storage::files('backups');

        $perPage = 20;
        $page = $request->query('page', 1);
        $pagedData = array_slice($backupFiles, ($page - 1) * $perPage, $perPage);

        $paginator = new LengthAwarePaginator($pagedData, count($backupFiles), $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        return view('admin/settings/index', compact('paginator'));
    }

    public function createBackupDatabase(Request $request) {
        $this->backupService->createBackupDatabase();
        return redirect()->route('admin.settings.index');
    }

    public function restoreDatabase(Request $request) {
        $this->backupService->restoreDatabase($request->input('backup_file'));
        return redirect()->route('admin.settings.index');
    }
}
