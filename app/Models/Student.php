<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];
    protected $casts = [
        'birth_date' => 'date',
    ];
    public function getBirthDateFormattedAttribute()
    {
        return $this->birth_date?->format('d-m-Y');
    }
}
