<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'students';
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'token',
        'verified'
    ];
}
