<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;

class Notifier
{
    const KEY = 'admin_notifications';

    public static function add(string $title, string $message)
    {
        $items = Cache::get(self::KEY, []);

        array_unshift($items, [
            'id' => uniqid(),
            'title' => $title,
            'message' => $message,
            'time' => now()->format('d M Y, H:i'),
            'read' => false,
        ]);

        $items = array_slice($items, 0, 20); // simpan maksimal 20 terbaru
        Cache::put(self::KEY, $items, now()->addDays(7));
    }

    public static function all()
    {
        return collect(Cache::get(self::KEY, []));
    }

    public static function unreadCount()
    {
        return self::all()->where('read', false)->count();
    }

    public static function markAllRead()
    {
        $items = Cache::get(self::KEY, []);
        foreach ($items as &$item) {
            $item['read'] = true;
        }
        Cache::put(self::KEY, $items, now()->addDays(7));
    }
}