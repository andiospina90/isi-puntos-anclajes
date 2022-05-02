<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntoAnclaje extends Model
{
    use HasFactory;
    protected $table = 'isi_puntos_anclaje';

    protected $fillable = [
        'sistema_proteccion',
        'id_empresa',
        'serial',
        'precinto',
        'fecha_instalacion',
        'fecha_inspeccion',
        'marca',
        'numero_usuarios',
        'uso',
        'observaciones',
        'ubicacion',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class,'id_empresa','id');
    }
}
