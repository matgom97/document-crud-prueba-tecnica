<?php

namespace App\Middleware;

use App\Contracts\MiddlewareInterface;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle(): void
    {
        if (empty($_SESSION['user'])) {
            header('Location: /document-crud/public/login');
            exit;
        }
    }
}