<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    use HasFactory;

    protected $table='tbl_facturadetalle';
    protected $primaryKey = 'idfacturadetalle';

    protected $fillable = ['cantidad','precio','subtotal','idarticulo','idfactura'];

    public $timestamps = false;
}
