<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function classrooms()
    {
        return $this->BelongsToMany(Classroom::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
