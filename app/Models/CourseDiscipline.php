<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseDiscipline extends Model
{
    protected $table = 'course_disciplines';

    protected $fillable = ['course_name', 'discipline', 'weight_percent'];
}
