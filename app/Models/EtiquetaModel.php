<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtiquetaModel extends Model
{
    use HasFactory;

    protected $table = 'etiquetas';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre'
    ];

    public function entradas()
    {
        return $this->belongsToMany(EntradasModel::class, 'entradas_etiquetas', 'etiqueta_id', 'entrada_id');
    }
}
