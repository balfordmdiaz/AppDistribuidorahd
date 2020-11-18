<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;

    protected $table='tbl_articulostock';
    protected $primaryKey = 'idarticulos';

    protected $fillable = ['idlarticulos','nombrearticulo','idcategoria'];


    public $timestamps = false;


}
