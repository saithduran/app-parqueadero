<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registro extends Model{
    
    use HasFactory;
    
    protected $fillable = ['placa', 'hora_ingreso', 'hora_salida', 'total_pago', 'estado'];
}

