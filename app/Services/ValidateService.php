<?php

namespace App\Services;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\TypeEntertainment;
use App\Models\User;
use App\Models\Vote;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ValidateService
{
    public static function rectifyParams(array $params): array
    {
        return array_map('mb_strtoupper', array_map('trim', $params));
    }

    public static function paramsCreateMovie(array $params): array
    {
        try {
            $returnMovie = Movie::where('title', $params['title'])->get();
            if ($returnMovie === false) {
                throw new Exception("Erro ao verificar Filme/Série existente. Por favor tente mais tarde");
            }
            if (count($returnMovie)) {
                throw new Exception("Filme ou Série já existente com esse Título");
            }

            $returnGenre = Genre::where('id', $params['genre'])->get();
            if ($returnGenre === false) {
                throw new Exception("Erro ao verificar Gênero. Por favor tente mais tarde");
            }
            if (!count($returnGenre)) {
                throw new Exception("Gênero não cadastrado");
            }

            $returnType = TypeEntertainment::where('id', $params['type_entertainment'])->get();
            if ($returnType === false) {
                throw new Exception("Erro ao verificar Gênero. Por favor tente mais tarde");
            }
            if (!count($returnType)) {
                throw new Exception("Tipo de Entretenimento não cadastrado");
            }

            return [
                'error' => false,
                'params' => 'Parâmetros validados com sucesso'
            ];
        } catch (\Throwable $th) {
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }
    }

    public static function paramsUpdateMovie(array $params, int $id): array
    {
        try {
            $returnMovie = Movie::where('id', $id)->get();
            if ($returnMovie === false) {
                throw new Exception("Erro ao verificar ID Filme/Série existente. Por favor tente mais tarde");
            }
            if (!count($returnMovie)) {
                throw new Exception("Filme ou Série não encontrado com esse ID");
            }

            $returnValidate = static::paramsCreateMovie($params);
            if ($returnValidate['error']) {
                throw new Exception($returnValidate['message']);
            }

            return [
                'error' => false,
                'message' => 'Parâmetros validados com sucesso'
            ];
        } catch (\Throwable $th) {
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }
    }

    public static function paramsCreateVote(array $params): array
    {
        try {
            $returnMovie = Movie::where('id', $params['movie_id'])->get();
            if ($returnMovie === false) {
                throw new Exception("Erro ao verificar Filme/Série existente. Por favor tente mais tarde");
            }
            if (!count($returnMovie)) {
                throw new Exception("Filme ou Série não encontrado com esse ID");
            }

            $returnVote = Vote::where('users_id', 1)
                ->get();
            if ($returnVote === false) {
                throw new Exception("Erro ao verificar se já existe Votação para esse usuário");
            }
            if (count($returnVote)) {
                throw new Exception("Votação para esse usuário já existente");
            }

            return [
                'error' => false,
                'message' => 'Parâmetros validados com sucesso'
            ];
        } catch (\Throwable $th) {
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }
    }

    public static function paramsCreateUser(array $params): array
    {
        try {
            $password = $params['password'];
            $params = static::rectifyParams($params);

            $returnUser = User::where('email', $params['email'])->get();
            if ($returnUser === false) {
                throw new Exception("Erro ao verificar usuário. Por favor tente mais tarde");
            }
            if (count($returnUser)) {
                throw new Exception("Usuário já cadastro com esse e-mail");
            }

            $params['password'] = Hash::make($password);
            $params['situation'] = 'A';

            return [
                'error' => false,
                'params' => $params,
                'message' => 'Parâmetros validados com sucesso'
            ];
        } catch (\Throwable $th) {
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }
    }

    public static function paramsFilterData(array $params): array
    {
        try {
            if (!count($params)) {
                return [
                    'error' => false,
                    'condition' => [],
                ];
            }

            $condition = [];
            $params = static::rectifyParams($params);
            if (isset($params['title']) && !empty($params['title'])) {
                $condition[] = ['movie.title', 'like', '%'.$params['title'].'%'];
            }

            if (isset($params['description']) && !empty($params['description'])) {
                $condition[] = ['movie.description', 'like', '%'.$params['description'].'%'];
            }

            if (isset($params['age_classification']) && !empty($params['age_classification'])) {
                $condition[] = ['movie.age_classification', '=', $params['age_classification']];
            }

            if (isset($params['genre']) && !empty($params['genre'])) {
                $returnGenre = Genre::where('name', $params['genre'])->get();
                if ($returnGenre === false) {
                    throw new Exception("Erro ao buscar o gênero. Por favor tente mais tarde");
                }
                if (!count($returnGenre)) {
                    throw new Exception("Gênero não encontrado");
                }

                $condition[] = ['movie.genre_id', '=', $returnGenre[0]->id];
            }

            if (isset($params['genre']) && !empty($params['genre'])) {
                $returnGenre = Genre::where('name', $params['genre'])->get();
                if ($returnGenre === false) {
                    throw new Exception("Erro ao buscar o gênero. Por favor tente mais tarde");
                }
                if (!count($returnGenre)) {
                    throw new Exception("Gênero não encontrado");
                }

                $condition[] = ['movie.genre_id', '=', $returnGenre[0]->id];
            }

            if (isset($params['type_entertainment']) && !empty($params['type_entertainment'])) {
                $returnType = TypeEntertainment::where('name', $params['type_entertainment'])->get();
                if ($returnType === false) {
                    throw new Exception("Erro ao buscar o Tipo de entretenimento. Por favor tente mais tarde");
                }
                if (!count($returnType)) {
                    throw new Exception("Tipo de Entretenimento não encontrado");
                }

                $condition[] = ['movie.type_entertainment_id', '=', $returnType[0]->id];
            }

            return [
                'error' => false,
                'condition' => $condition,
            ];
        } catch (\Throwable $th) {
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }
    }
}
