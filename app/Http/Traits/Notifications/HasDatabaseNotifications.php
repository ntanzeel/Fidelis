<?php

namespace App\Http\Traits\Notifications;

use App\Models\Notification;

trait HasDatabaseNotifications {

    /**
     * Get the entity's notifications.
     */
    public function notifications() {
        return $this->morphMany(Notification::class, 'notifiable')
            ->orderBy('created_at', 'desc');
    }

    /**
     * Get the entity's unread notifications.
     */
    public function unreadNotifications() {
        return $this->morphMany(Notification::class, 'notifiable')
            ->whereNull('read_at')
            ->orderBy('created_at', 'desc');
    }

    public function readNotifications() {
        return $this->morphMany(Notification::class, 'notifiable')
            ->whereNotNull('read_at')
            ->orderBy('created_at', 'desc');
    }
}