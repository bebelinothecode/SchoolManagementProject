<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
    protected $table = 'school_fees';

    protected $fillable = [
        'school_fees',
        'currency',
        'session',
        'student_type',
        'start_academic_year',
        'end_academic_year'
    ];

    use HasFactory;
}
