<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table='tbl_orden';
    protected $primaryKey = 'idorden';

    protected $fillable = ['idlorden','fechaorden','subtotal','total','idproveedor'];

    public $timestamps = false;

}
