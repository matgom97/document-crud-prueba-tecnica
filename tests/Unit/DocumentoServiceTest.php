<?php

use PHPUnit\Framework\TestCase;
use App\Services\DocumentoService;
use App\Contracts\DocumentoRepositoryInterface;
use App\Contracts\TipoRepositoryInterface;
use App\Contracts\ProcesoRepositoryInterface;

class DocumentoServiceTest extends TestCase
{
    private $repositoryMock;
    private $tipoRepositoryMock;
    private $procesoRepositoryMock;
    private $service;

    protected function setUp(): void
    {
        $this->repositoryMock = $this->createMock(DocumentoRepositoryInterface::class);
        $this->tipoRepositoryMock = $this->createMock(TipoRepositoryInterface::class);
        $this->procesoRepositoryMock = $this->createMock(ProcesoRepositoryInterface::class);

        $this->service = new DocumentoService(
            $this->repositoryMock,
            $this->tipoRepositoryMock,
            $this->procesoRepositoryMock
        );
    }

    public function test_generates_first_consecutivo(): void
    {
        $tipoFake = (object) ['id' => 1, 'prefijo' => 'INS'];
        $procesoFake = (object) ['id' => 1, 'prefijo' => 'ING'];

        $this->tipoRepositoryMock
            ->method('find')
            ->willReturn($tipoFake);

        $this->procesoRepositoryMock
            ->method('find')
            ->willReturn($procesoFake);

        $this->repositoryMock
            ->method('getNextConsecutivo')
            ->willReturn(1);

        $this->repositoryMock
            ->expects($this->once())
            ->method('create')
            ->with($this->callback(function ($data) {
                return $data['codigo'] === 'INS-ING-1'
                    && $data['consecutivo'] === 1;
            }));

        $this->service->create([
            'tipo_id' => 1,
            'proceso_id' => 1,
            'nombre' => 'Test',
            'contenido' => 'Contenido'
        ]);
    }

    public function test_increments_consecutivo(): void
    {
        $tipoFake = (object) ['id' => 1, 'prefijo' => 'INS'];
        $procesoFake = (object) ['id' => 1, 'prefijo' => 'ING'];

        $this->tipoRepositoryMock
            ->method('find')
            ->willReturn($tipoFake);

        $this->procesoRepositoryMock
            ->method('find')
            ->willReturn($procesoFake);

        $this->repositoryMock
            ->method('getNextConsecutivo')
            ->willReturn(2);

        $this->repositoryMock
            ->expects($this->once())
            ->method('create')
            ->with($this->callback(function ($data) {
                return $data['codigo'] === 'INS-ING-2'
                    && $data['consecutivo'] === 2;
            }));

        $this->service->create([
            'tipo_id' => 1,
            'proceso_id' => 1,
            'nombre' => 'Test',
            'contenido' => 'Contenido'
        ]);
    }

    public function test_update_calls_repository(): void
    {
        $documentoFake = (object) [
            'tipo_id' => 1,
            'proceso_id' => 1
        ];

        $this->repositoryMock
            ->method('find')
            ->willReturn($documentoFake);

        $this->repositoryMock
            ->expects($this->once())
            ->method('update')
            ->with(5, $this->anything());

        $this->service->update(5, [
            'tipo_id' => 1,
            'proceso_id' => 1
        ]);
    }

    public function test_delete_calls_repository(): void
    {
        $this->repositoryMock
            ->expects($this->once())
            ->method('delete')
            ->with(10);

        $this->service->delete(10);
    }

    public function test_search_calls_repository(): void
    {
        $this->repositoryMock
            ->expects($this->once())
            ->method('search')
            ->with('ABC');

        $this->service->search('ABC');
    }
}