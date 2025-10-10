<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $guarded = [];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function school_year()
    {
        return $this->belongsTo(SchoolYear::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
