<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'birth_date' => 'date',
    ];
    public function getBirthDateFormattedAttribute()
    {
        return $this->birth_date?->format('d-m-Y');
    }

    public function classrooms()
    {
        return $this->BelongsToMany(Classroom::class);
    }

    public function classroom_student()
    {
        return $this->belongsToMany(ClassroomStudent::class);
    }
}
