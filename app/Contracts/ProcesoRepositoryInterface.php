<?php

namespace App\Contracts;

interface ProcesoRepositoryInterface
{
    public function find(int $id);
}