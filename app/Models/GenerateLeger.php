<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenerateLeger extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'classrooms';

    public function school_year()
    {
        return $this->belongsTo(SchoolYear::class);
    }
    public function hr_teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function classroom_student()
    {
        return $this->belongsToMany(ClassroomStudent::class);
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class, 'classroom_student');
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
