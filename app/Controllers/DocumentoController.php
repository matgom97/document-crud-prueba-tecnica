<?php

namespace App\Controllers;

use App\Contracts\DocumentoServiceInterface;
use App\Models\TipoDocumento;
use App\Models\Proceso;

class DocumentoController
{
    private DocumentoServiceInterface $service;

    public function __construct(DocumentoServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(): void
    {
        $term = $_GET['q'] ?? null;

        $documentos = $this->service->search($term);

        require __DIR__ . '/../../views/documentos/index.php';
    }

    public function createForm(): void
    {
        $tipos = TipoDocumento::all();
        $procesos = Proceso::all();

        require __DIR__ . '/../../views/documentos/create.php';
    }

    public function store(): void
    {
        $this->service->create($_POST);

        header('Location: /document-crud/public/documentos');
        exit;
    }

    public function editForm(): void
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: /document-crud/public/documentos');
            exit;
        }

        $documento = $this->service->find($id);
        $tipos = TipoDocumento::all();
        $procesos = Proceso::all();

        require __DIR__ . '/../../views/documentos/edit.php';
    }

    public function update(): void
    {
        $this->service->update($_POST['id'], $_POST);

        header('Location: /document-crud/public/documentos');
        exit;
    }

    public function delete(): void
    {
        $this->service->delete($_POST['id']);

        header('Location: /document-crud/public/documentos');
        exit;
    }
    
}