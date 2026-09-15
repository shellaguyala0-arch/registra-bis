<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function log(
        string $action,
        string $description,
        ?string $module = null,
        ?int $recordId = null
    ): void {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'description' => $description,
            'module' => $module,
            'record_id' => $recordId,
            'ip_address' => request()->ip(),
        ]);
    }
}