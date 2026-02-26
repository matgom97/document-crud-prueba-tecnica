<?php

namespace App\Contracts;

interface AuthServiceInterface
{
    public function attempt(string $username, string $password): bool;
    public function logout(): void;
    public function check(): bool;
}