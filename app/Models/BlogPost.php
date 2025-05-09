<?php

namespace App\Models;

use App\Traits\CreatedByTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BlogPost extends Model
{
    use CreatedByTrait;

    protected $fillable = [
        'title',
        'body',
        'cover',
        'draft',
        'images',
        'race_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function races(): BelongsToMany
    {
        return $this->belongsToMany(Race::class, 'blog_posts_races', 'blog_post_id', 'race_id');
    }
}
