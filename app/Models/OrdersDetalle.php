<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersDetalle extends Model
{
    use HasFactory;

    protected $table='tbl_ordendetalle';
    protected $primaryKey = 'idordendetalle';

    protected $fillable = ['cantidadorden','precio','monto','idarticulov','idorden'];

    public $timestamps = false;
}
