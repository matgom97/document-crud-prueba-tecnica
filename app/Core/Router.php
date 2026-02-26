<?php

namespace App\Core;

class Router
{
    private array $routes = [];
    private ?string $lastMethod = null;
    private ?string $lastUri = null;

    public function get(string $uri, array $action): self
    {
        $this->routes['GET'][$uri] = [
            'action' => $action,
            'middleware' => []
        ];

        $this->lastMethod = 'GET';
        $this->lastUri = $uri;

        return $this;
    }

    public function post(string $uri, array $action): self
    {
        $this->routes['POST'][$uri] = [
            'action' => $action,
            'middleware' => []
        ];

        $this->lastMethod = 'POST';
        $this->lastUri = $uri;

        return $this;
    }

    public function middleware(string $middleware): self
    {
        if ($this->lastMethod && $this->lastUri) {
            $this->routes[$this->lastMethod][$this->lastUri]['middleware'][] = $middleware;
        }

        return $this;
    }

    public function dispatch(string $uri, string $method): void
    {
        if (!isset($this->routes[$method][$uri])) {
            http_response_code(404);
            echo "404 - Página no encontrada";
            return;
        }

        $route = $this->routes[$method][$uri];

        // Ejecutar middlewares
        foreach ($route['middleware'] as $middleware) {
            $instance = new $middleware();
            $instance->handle();
        }

        call_user_func($route['action']);
    }
}