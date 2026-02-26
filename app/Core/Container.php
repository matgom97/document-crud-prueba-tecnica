<?php

namespace App\Core;

class Container
{
    private array $bindings = [];

    public function bind(string $abstract, string $concrete)
    {
        $this->bindings[$abstract] = $concrete;
    }

    public function make(string $class)
    {
        if (isset($this->bindings[$class])) {
            $class = $this->bindings[$class];
        }

        $reflector = new \ReflectionClass($class);

        $constructor = $reflector->getConstructor();

        if (!$constructor) {
            return new $class;
        }

        $dependencies = [];

        foreach ($constructor->getParameters() as $param) {
            $type = $param->getType()->getName();
            $dependencies[] = $this->make($type);
        }

        return $reflector->newInstanceArgs($dependencies);
    }
}