<?php

namespace App\Support;

use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ActivityLogger
{
    private static function iconForAction($action)
    {
        return match ($action) {
            'created' => 'artikel-baru',
            'updated' => 'produk-update',
            'deleted' => 'komentar-hapus',
            default => 'sistem-update',
        };
    }

    public static function log($action, $title, $desc, $icon = null)
    {
        $logs = Session::get('activity_log', []);

        array_unshift($logs, [
            'icon' => $icon ?? self::iconForAction($action),
            'title' => $title,
            'desc' => $desc,
            'timestamp' => now()->toDateTimeString(),
        ]);

        Session::put('activity_log', array_slice($logs, 0, 20));
    }

    public static function latest($count = 5)
    {
        $logs = Session::get('activity_log', []);

        return collect($logs)->take($count)->map(function ($log) {
            $log['time'] = Carbon::parse($log['timestamp'])->locale('id')->diffForHumans();
            return $log;
        })->values();
    }
}