<?php

namespace App\Controllers;

use App\Contracts\AuthServiceInterface;

class AuthController
{
    private AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function showLogin(): void
    {
        require __DIR__ . '/../../views/auth/login.php';
    }

    public function login(): void
    {
        
        if ($this->authService->attempt($_POST['username'], $_POST['password'])) {
            header('Location: /document-crud/public/documentos');
            
            exit;
        }

        $_SESSION['error'] = "Credenciales inválidas";
        header('Location: /document-crud/public/login');
        exit;
    }

    public function logout(): void
    {
        $this->authService->logout();
        header('Location: /document-crud/public/login');
        exit;
    }
}