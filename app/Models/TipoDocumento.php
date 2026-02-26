<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table = 'tip_tipo_doc';

    protected $fillable = [
        'nombre',
        'prefijo'
    ];

    public $timestamps = false;

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'tipo_id');
    }
}