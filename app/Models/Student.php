<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'passport_number',
        'email',
        'phone_number',
        'address',
        'gpa',
        'ielts_score',
    ];

    protected $casts = [
        'gpa' => 'decimal:2',
        'ielts_score' => 'decimal:1',
    ];

    // Accessor for full name
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
