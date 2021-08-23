<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    public $table = 'productos'; //nombre de la tabla
    protected $primaryKey = 'id'; //nombre de la llave primaria

    // columnas de la tabla en la bd
    protected $fillable = [
        'producto',
        'cantidad',
        'numero_lote',
        'fecha_vencimiento',
        'precio',
        'estado_producto',
        'estado'
    ];
}
