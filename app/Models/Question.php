<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

class Question extends Authenticatable
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'questions';
    protected $softDelete = true;

    protected $fillable = ['question_type','question','questionImage'];
}
