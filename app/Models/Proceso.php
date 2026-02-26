<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    protected $table = 'pro_proceso';

    protected $fillable = [
        'nombre',
        'prefijo'
    ];

    public $timestamps = false;

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'proceso_id');
    }
}