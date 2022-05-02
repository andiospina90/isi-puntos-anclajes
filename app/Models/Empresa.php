<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $table = 'isi_empresas';

    public function puntoAnclaje()
    {
        return $this->hasMany(PuntoAnclaje::class,'id_empresa','id');
    }
}

