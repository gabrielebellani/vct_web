<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $table = 'races';

    protected $fillable = [
        'name',
        'description',
        'date',
        'location',
        'class',
        'age',
        'main_type',
        'sub_type',
    ];

    protected $casts = [
        'class' => 'array'
    ];

}
