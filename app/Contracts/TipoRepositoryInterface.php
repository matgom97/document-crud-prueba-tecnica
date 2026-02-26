<?php

namespace App\Contracts;

interface TipoRepositoryInterface
{
    public function find(int $id);
}