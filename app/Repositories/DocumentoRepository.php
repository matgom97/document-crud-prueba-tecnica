<?php

namespace App\Repositories;

use App\Contracts\DocumentoRepositoryInterface;
use App\Models\Documento;

class DocumentoRepository implements DocumentoRepositoryInterface
{
    public function all()
    {
        return Documento::with(['tipo', 'proceso'])->get();
    }

    public function find(int $id): Documento
    {
        return Documento::findOrFail($id);
    }

    public function create(array $data): Documento
    {
        return Documento::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $documento = $this->find($id);
        return $documento->update($data);
    }

    public function delete(int $id): bool
    {
        $documento = $this->find($id);
        return $documento->delete();
    }

    public function getNextConsecutivo(int $tipoId, int $procesoId): int
    {
        $last = Documento::where('tipo_id', $tipoId)
            ->where('proceso_id', $procesoId)
            ->max('consecutivo');

        return $last ? $last + 1 : 1;
    }
    public function search(?string $term)
    {
        $query = Documento::with(['tipo', 'proceso']);

        if ($term) {
            $query->where(function ($q) use ($term) {
                $q->where('nombre', 'LIKE', "%{$term}%")
                ->orWhere('codigo', 'LIKE', "%{$term}%");
            });
        }

        return $query->get();
    }
}