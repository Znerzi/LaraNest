<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    // Allow these fields to be filled when creating or updating an applicant
    protected $fillable = [
        'name',
        'email',
        'phone',
        'position',
        'experience',
        'description',
        'status',
    ];
}
