<?php

namespace App\Models;

use App\Models\ProductStock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table='tbl_categoria';
    protected $primaryKey = 'idcategoria';

    protected $fillable = ['idlcategoria','descripcion'];

    public $timestamps = false;


}
