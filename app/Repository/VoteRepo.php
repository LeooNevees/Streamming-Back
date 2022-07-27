<?php

namespace App\Repository;

use App\Models\Vote;

class VoteRepo
{
    public static function create(array $params): mixed
    {
        return Vote::create([
            'title' => $params['title'],
            'description' => $params['description'],
            // 'users_id' => $params['users_id'],
            'users_id' => 1,
            'movie_id' => $params['movie_id'],
            'situation' => 'A',
        ]);
    }
}
