<?php

namespace App\Models;

use App\Traits\CreatedByTrait;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use CreatedByTrait;

    protected $fillable = [
        'title',
        'body',
        'cover',
        'draft',
        'images'
    ];
}
