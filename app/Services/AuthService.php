<?php

namespace App\Services;

use App\Contracts\AuthServiceInterface;

class AuthService implements AuthServiceInterface
{
    private const USERNAME = 'admin';
    private const PASSWORD = '123456';

    public function attempt(string $username, string $password): bool
    {
        if ($username === self::USERNAME && $password === self::PASSWORD) {
            session_regenerate_id(true);
            $_SESSION['user'] = $username;
            return true;
        }

        return false;
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
    }

    public function check(): bool
    {
        return !empty($_SESSION['user']);
    }
}