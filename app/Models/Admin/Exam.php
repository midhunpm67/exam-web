<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

class Exam extends Authenticatable
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'exams';
    protected $softDelete = true;
}
