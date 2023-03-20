<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    use HasFactory;

    protected $table='tbl_factura';
    protected $primaryKey = 'idfactura';

    protected $fillable = ['idlfactura','fechafactura','iva','descuento','total','idcliente','idempleado', 'idcambiodollar'];

    public $timestamps = false;
}
