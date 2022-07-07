<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use HasFactory,SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'admins';
    protected $softDelete = true;

    protected $fillable = [
        'name',
        'email',
        'password',
        'usertype'
    ];
}
