<?php

namespace App\Contracts;

/**
 * ==========================================
 * O - Open/Closed Principle (OCP)
 * ==========================================
 * Abierta para extensión. Podemos crear más implementaciones
 * (EmailNotificationService, SmsNotificationService, etc.)
 * sin tener que modificar la lógica existente del sistema.
 */
interface NotificationServiceInterface
{
    public function send(string $message): void;
}
