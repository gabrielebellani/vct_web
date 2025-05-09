<?php

namespace App\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BlogPostsRacesHelper
{
    public static function raceHasPosts(int $raceId): bool
    {
        return DB::table('blog_posts_races')
            ->where('race_id', $raceId)
            ->exists();
    }

    public static function racesHavePosts(Collection $races): bool
    {
        return DB::table('blog_posts_races')
            ->where('race_id', 'in', $races->pluck('id')->toArray())
            ->exists();
    }
}