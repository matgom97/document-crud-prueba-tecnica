<?php

namespace App\Repositories;

use App\Contracts\TipoRepositoryInterface;
use App\Models\TipoDocumento;

class TipoRepository implements TipoRepositoryInterface
{
    public function find(int $id)
    {
        return TipoDocumento::findOrFail($id);
    }
}