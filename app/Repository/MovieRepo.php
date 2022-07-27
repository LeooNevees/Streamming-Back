<?php

namespace App\Repository;

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
            'genre_id' => $params['genre'],
            'type_entertainment_id' => $params['type_entertainment'],
            'created_user_id' => 1,
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

    public static function getJoinGenreTypeVote(array $conditions): mixed
    {
        return Movie::join('genre', 'movie.genre_id', '=', 'genre.id')
            ->join('type_entertainment', 'movie.type_entertainment_id', '=', 'type_entertainment.id')
            ->leftJoin('vote', 'movie.id', '=', 'vote.movie_id')
            ->where($conditions)
            ->select(
                'movie.title as titulo',
                'movie.description as descricao',
                'movie.duration as duracao',
                'movie.age_classification as classificacao_idade',
                'genre.name as genero',
                'type_entertainment.name as tipo',
                DB::raw('COUNT(vote.id) as quantidade_votos')
            )
            ->groupBy(
                'movie.title',
                'movie.description',
                'movie.duration',
                'movie.age_classification',
                'genre.name',
                'type_entertainment.name'
            )
            ->get();
    }
}
