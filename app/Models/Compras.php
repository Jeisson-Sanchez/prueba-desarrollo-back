<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;

    public $table = 'compras'; //nombre de la tabla
    protected $primaryKey = 'id'; //nombre de la llave primaria

    // columnas de la tabla en la bd
    protected $fillable = [
        'nombre_cliente',
        'id_producto',
        'cantidad',
        'precio_total',
        'estado',
    ];

    public function producto(){
        return $this->belongsTo(Productos::class, 'id_producto', 'id');
    }
}
