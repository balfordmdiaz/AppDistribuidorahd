<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Userfact extends Authenticatable
{
    use HasFactory,Notifiable;

    protected $table='tbl_usuario';
    protected $primaryKey = 'idusuario';

    protected $fillable = ['username','email','password','idempleado'];

    public $timestamps = false;

}
