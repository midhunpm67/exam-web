<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

class ExamQuestion extends Authenticatable
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'exam_questions';
    protected $softDelete = true;
}
