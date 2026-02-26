<?php

namespace App\Repositories;

use App\Contracts\ProcesoRepositoryInterface;
use App\Models\Proceso;

class ProcesoRepository implements ProcesoRepositoryInterface
{
    public function find(int $id)
    {
        return Proceso::findOrFail($id);
    }
}