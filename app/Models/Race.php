<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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
        'age' => 'array'
    ];

    public function setAgeAttribute($value): void
    {
        $this->attributes['age'] = json_encode($value);
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(BlogPost::class, 'blog_posts_races', 'race_id', 'blog_post_id');
    }

}
