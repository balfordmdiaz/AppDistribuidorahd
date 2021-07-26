<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;

    protected $table='tbl_clientes';
    protected $primaryKey = 'idcliente';

    protected $fillable = ['idlcliente','nombrecompleto','cedula','telefono','departamento','direccion','email'];

    public $timestamps = false;
}
