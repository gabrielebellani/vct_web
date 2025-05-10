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

    public static function getRacesInfoFromCollectionString(?Collection $collection): string
    {

        if(!$collection) return '<span class="text-sm text-gray-400">Nessuna gara correlata</span>';

        $string = '<ul>';
        foreach ($collection as $race) {
            $string .= '<li class="text-sm text-gray-800 dark:text-white"> - '. $race->name . ' (' . $race->location . ')</li>';
        }
        return $string . '</ul>';
    }
}