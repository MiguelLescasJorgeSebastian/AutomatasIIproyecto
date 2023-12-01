<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'tipo',
        'metrosCuadrados',
        'metrosConstruccion',
        'precio',
        'direccion',
        'fotos',

    ];
}
