<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'client';

    protected $fillable = [
        'first_name',
        'last_name',
        'contact',
        'gender',
        'street_address',
        'city',
        'email',
        'dob_year',
        'dob_month',
        'dob_day',
        'status',
    ];

    protected $casts = [
        'dob_year' => 'integer',
        'dob_month' => 'integer',
        'dob_day' => 'integer',
    ];
}
