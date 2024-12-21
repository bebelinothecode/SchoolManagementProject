<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'parent_id',
        'class_id',
        'roll_number',
        'gender',
        'phone',
        'dateofbirth',
        'current_address',
        'permanent_address',
        'index_number',
        'academicyear',
        'session',
        'student_type'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function parent() 
    {
        return $this->belongsTo(Parents::class);
    }

    public function class() 
    {
        return $this->belongsTo(Grade::class, 'class_id');
    }

    public function attendances() 
    {
        return $this->hasMany(Attendance::class);
    }

    public function borrow() 
    {
        return $this->hasMany(Book::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->index_number) {
                $model->index_number = static::generateCustomId();
            }
        });
    }

    protected static function generateCustomId()
    {
        $prefix = 'STUD-';
        $number = str_pad(mt_rand(1, 999999), 8, '0', STR_PAD_LEFT);

        // Ensure uniqueness
        $indexnumber = $prefix . $number;
        while (self::where('index_number', $indexnumber)->exists()) {
            $number = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
            $indexnumber = $prefix . $number;
        }
        return $indexnumber;
    }
}
