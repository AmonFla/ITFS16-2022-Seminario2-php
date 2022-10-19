<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntradaModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'entradas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'contenido',
        'fecha_pub'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categorias()
    {
        return $this->belongsTo(CategoriaModel::class);
    }

    public function etiquetas()
    {
        return $this->hasMany(EtiquetasModel::class);
    }
}
