<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;

    protected $table='tbl_articulostock';
    protected $primaryKey = 'idarticulostock';

    protected $fillable = ['idlarticulos','nombrearticulo','cantidadexistente','idcategoria'];

    public $timestamps = false;


}
