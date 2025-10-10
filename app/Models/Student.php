<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function classroom_student()
    {
        return $this->belongsToMany(ClassroomStudent::class);
    }
    public function values()
    {
        return $this->hasMany(Value::class);
    }
    public function classrooms(): BelongsToMany
    {
        // Tentukan model tujuan (Classroom) dan nama tabel pivotnya
        return $this->belongsToMany(Classroom::class, 'classroom_student');
    }
}
