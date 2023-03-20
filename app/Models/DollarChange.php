<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cambioDollar extends Model
{
    use HasFactory;
    protected $table='tbl_cambiodollar';
    protected $primaryKey = 'idcambiodollar';

    protected $fillable = ['cambio'];

    public $timestamps = false;
}
