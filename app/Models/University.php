<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'name',
        'city',
        'subjects_name',
        'bachelor',
        'masters',
        'scholarship',
        'tuition_fees',
        'application_fees',
        'requirements',
        'ielts',
        'minimum_cgpa',
    ];
}
