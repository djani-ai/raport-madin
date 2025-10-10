<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function school_year()
    {
        return $this->belongsTo(SchoolYear::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function subjects()
    {
        return $this->belongsTo(Subject::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function teachers()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function values()
    {
        return $this->hasMany(Value::class);
    }
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
    public function students()
    {
        return $this->hasMany(Value::class);
    }
    protected static function booted(): void
    {
        static::created(function (Schedule $schedule) {
            $activeSchoolYear = SchoolYear::where('is_active', true)->first();
            if (!$activeSchoolYear) {
                return;
            }
            $students = $schedule->classroom?->students;
            if ($students && $students->isNotEmpty()) {
                $valuesToInsert = [];
                $now = Carbon::now();
                foreach ($students as $student) {
                    $valuesToInsert[] = [
                        'school_year_id' => $activeSchoolYear->id,
                        'schedule_id'    => $schedule->id,
                        'student_id'     => $student->id,
                        'value'          => 0,
                        'created_at'     => $now,
                        'updated_at'     => $now,
                    ];
                }
                Value::insert($valuesToInsert);
            }
        });
        static::deleting(function (Schedule $schedule) {
            $schedule->values()->delete();
        });
        static::addGlobalScope('activeSchoolYear', function ($query) {
            $query->whereHas('school_year', function ($q) {
                $q->where('is_active', true);
            });
        });
    }
}
