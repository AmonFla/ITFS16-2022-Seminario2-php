<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categorias';
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
        return $this->hasMany(EntradaModel::class);
    }
}
