<?php

namespace App\Core;

class ExceptionHandler
{
    public static function handle(\Throwable $exception): void
    {
        // Log del error
        Logger::error($exception->getMessage(), [
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString()
        ]);

        http_response_code(500);

        require __DIR__ . '/../../views/errors/500.php';
        exit;
    }
}