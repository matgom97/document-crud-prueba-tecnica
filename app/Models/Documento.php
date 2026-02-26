<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'doc_documento';

    protected $fillable = [
        'nombre',
        'codigo',
        'contenido',
        'tipo_id',
        'proceso_id',
        'consecutivo'
    ];

    public $timestamps = false;

    public function tipo()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_id');
    }

    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'proceso_id');
    }
}