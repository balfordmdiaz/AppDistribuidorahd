<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Providers extends Model
{
    use HasFactory;

    protected $table='tbl_proveedor';
    protected $primaryKey = 'idproveedor';

    protected $fillable = ['idlproveedor','nombreproveedor','telefono','direccion','email'];

    public $timestamps = false;
}
