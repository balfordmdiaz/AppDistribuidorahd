<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table='tbl_articulovariante';
    protected $primaryKey = 'idarticulov';

    protected $fillable = ['idlarticulov','talla','color','cantidad','precio','idarticulos'];

    public $timestamps = false;
}