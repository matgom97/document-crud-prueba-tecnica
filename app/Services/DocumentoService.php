<?php

namespace App\Services;

use App\Contracts\DocumentoServiceInterface;
use App\Contracts\DocumentoRepositoryInterface;
use App\Contracts\TipoRepositoryInterface;
use App\Contracts\ProcesoRepositoryInterface;

class DocumentoService implements DocumentoServiceInterface
{
    private DocumentoRepositoryInterface $repository;
    private TipoRepositoryInterface $tipoRepository;
    private ProcesoRepositoryInterface $procesoRepository;

    public function __construct(
        DocumentoRepositoryInterface $repository,
        TipoRepositoryInterface $tipoRepository,
        ProcesoRepositoryInterface $procesoRepository
    ) {
        $this->repository = $repository;
        $this->tipoRepository = $tipoRepository;
        $this->procesoRepository = $procesoRepository;
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        $tipo = $this->tipoRepository->find($data['tipo_id']);
        $proceso = $this->procesoRepository->find($data['proceso_id']);

        $consecutivo = $this->repository
            ->getNextConsecutivo($tipo->id, $proceso->id);

        $data['codigo'] = "{$tipo->prefijo}-{$proceso->prefijo}-{$consecutivo}";
        $data['consecutivo'] = $consecutivo;

        return $this->repository->create($data);
    }

    public function update(int $id, array $data)
    {
        $documento = $this->repository->find($id);

        if (
            $documento->tipo_id != $data['tipo_id'] ||
            $documento->proceso_id != $data['proceso_id']
        ) {
            $tipo = $this->tipoRepository->find($data['tipo_id']);
            $proceso = $this->procesoRepository->find($data['proceso_id']);

            $consecutivo = $this->repository
                ->getNextConsecutivo($tipo->id, $proceso->id);

            $data['codigo'] = "{$tipo->prefijo}-{$proceso->prefijo}-{$consecutivo}";
            $data['consecutivo'] = $consecutivo;
        }

        return $this->repository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }

    public function search(?string $term)
    {
        return $this->repository->search($term);
    }
}