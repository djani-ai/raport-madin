<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
    protected $guarded = [];
    //
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function values(): HasMany
    {
        return $this->hasMany(Value::class, 'student_id', 'student_id')
            ->where('school_year_id', $this->school_year_id);
    }
    public function subject(): BelongsTo
    {
        // Asumsi: Tabel `schedules` memiliki `subject_id`
        // Jika tidak, relasi ini perlu disesuaikan
        return $this->belongsTo(Subject::class, 'schedule_id')
            ->via('schedule'); // Placeholder, ini perlu disesuaikan
    }
}
