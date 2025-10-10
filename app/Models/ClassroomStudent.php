<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassroomStudent extends Model
{
    protected $guarded = [];
    protected $table = 'classroom_student';

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
