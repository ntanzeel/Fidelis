<?php

namespace App\Http\Traits\Notifications;

use Illuminate\Notifications\RoutesNotifications;

trait Notifiable {
    use HasDatabaseNotifications, RoutesNotifications;
}