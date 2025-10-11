<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded = [];
    //
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
    public function school_year()
    {
        return $this->belongsTo(SchoolYear::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
