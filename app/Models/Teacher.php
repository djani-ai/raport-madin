<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'nip',
        'name',
        'phone',
        'address',
        'signature',
        'specialization',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function ($teacher) {
            // buat user otomatis kalau belum ada
            if (!$teacher->user_id) {
                $email = strtolower(str_replace(' ', '', $teacher->name));
                $email .= rand(10, 99); // tambahkan angka random
                $user = \App\Models\User::create([
                    'name' => $teacher->name,
                    'email' => $email . '@dabas.id',
                    'password' => bcrypt('password123'),
                ]);
                $teacher->user_id = $user->id;
            }
        });
        static::deleting(function ($teacher) {
            // hapus user otomatis
            if ($teacher->user) {
                $teacher->user->delete();
            }
        });
    }
}
