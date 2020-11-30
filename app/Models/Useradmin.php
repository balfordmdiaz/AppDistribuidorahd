<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Useradmin extends Authenticatable
{
    use HasFactory,Notifiable;

    protected $table='tbl_admin';
    protected $primaryKey = 'iduseradmin';

    protected $fillable = ['username','email','password'];

    public $timestamps = false;
}
