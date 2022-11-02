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
        'fecha_pub',
        'user_id',
        'categoria_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categorias()
    {
        return $this->belongsTo(CategoriaModel::class, 'categoria_id', 'id');
    }

    public function etiquetas()
    {
        return $this->belongsToMany(EtiquetaModel::class, 'entradas_etiquetas', 'entrada_id', 'etiqueta_id');
    }
}
