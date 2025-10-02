<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use Illuminate\Database\Eloquent\Attributes\UseEloquentBuilder;

class Grade extends Model
{
    protected $guarded = [];
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function school_year()
    {
        return $this->belongsTo(SchoolYear::class);
    }
    public function hr_teacher()
    {
        return $this->belongsTo(User::class);
    }

    public static function booted()
    {
        static::addGlobalScope('activeSchoolYear', function ($query) {
            $query->whereHas('school_year', function ($q) {
                $q->where('is_active', true);
            });
        });
    }
}
