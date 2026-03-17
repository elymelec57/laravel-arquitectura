<?php

namespace App\Services;

use App\Contracts\NotificationServiceInterface;
use Illuminate\Support\Facades\Log;

/**
 * Servicio concreto que implementa Notificaciones 
 * enviándolas al archivo de logs de Laravel.
 */
class LogNotificationService implements NotificationServiceInterface
{
    public function send(string $message): void
    {
        Log::info("SOLID Notification: " . $message);
    }
}
