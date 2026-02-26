<?php

namespace App\Core;

class Logger
{
    private static string $logFile = __DIR__ . '/../../storage/logs/app.log';

    public static function error(string $message, array $context = []): void
    {
        $date = date('Y-m-d H:i:s');

        $logMessage = "[{$date}] ERROR: {$message}";

        if (!empty($context)) {
            $logMessage .= " | Context: " . json_encode($context);
        }

        $logMessage .= PHP_EOL;

        self::write($logMessage);
    }

    private static function write(string $content): void
    {
        $directory = dirname(self::$logFile);

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        file_put_contents(self::$logFile, $content, FILE_APPEND);
    }
}