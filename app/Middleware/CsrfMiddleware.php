<?php

namespace App\Middleware;

use App\Contracts\MiddlewareInterface;

class CsrfMiddleware implements MiddlewareInterface
{
    public function handle(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (
                !isset($_POST['csrf_token']) ||
                !isset($_SESSION['csrf_token']) ||
                $_POST['csrf_token'] !== $_SESSION['csrf_token']
            ) {
                http_response_code(403);
                die('CSRF token inválido');
            }
        }
    }
}