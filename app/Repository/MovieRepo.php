<?php

namespace App\Repository;

use App\Models\ImageMovie;
use App\Models\Movie;
use App\Models\Vote;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MovieRepo
{
    public static function create(array $params): mixed
    {
        return Movie::create([
            'title' => $params['title'],
            'description' => $params['description'],
            'duration' => $params['duration'],
            'age_classification' => $params['age_classification'],
            'year_entry' => $params['year_entry'],
            'genre_id' => $params['genre'],
            'type_entertainment_id' => $params['type_entertainment'],
            'created_user_id' => $params['user'],
            'situation' => 'A',
        ]);
    }

    public static function update(int $id, array $params): mixed
    {
        return Movie::where('id', $id)->update([
            'title' => $params['title'],
            'description' => $params['description'],
            'duration' => $params['duration'],
            'age_classification' => $params['age_classification'],
            'genre_id' => $params['genre'],
            'type_entertainment_id' => $params['type_entertainment'],
            'situation' => $params['situation'],
        ]);
    }

    public static function getMoviesWithDescription(string $description, $orderBy = ['quantity_vote', 'desc']): mixed
    {
        return DB::table('vw_movies')
            ->where('title', 'like', "%$description%")
            ->orWhere('description', 'like', "%$description%")
            ->orWhere('genre_name', 'like', "%$description%")
            ->orWhere('type_entertainment_name', 'like', "%$description%")
            ->orderby($orderBy[0], $orderBy[1])
            ->get();
    }

    public static function getMoviesWithWhere($conditions, $orderBy = ['quantity_vote', 'desc']): mixed
    {
        return DB::table('vw_movies')
            ->where($conditions)
            ->orderby($orderBy[0], $orderBy[1])
            ->get();
    }

    public static function createImage(array $params): mixed
    {
        return ImageMovie::create([
            'path_image' => $params['path_image'],
            'movie_id' => $params['movie_id'],
            'situation' => 'A',
        ]);
    }
}
