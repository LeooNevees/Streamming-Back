<?php

namespace App\Services;

use App\Models\Movie;
use App\Repository\MovieRepo;
use Exception;

class MovieService
{
    public function index(): array
    {
        try {
            $movies = Movie::all();
            if ($movies === false) {
                throw new Exception("Erro ao buscar Filmes/Séries. Por favor tente novamente mais tarde");
            }

            return [
                'error' => false,
                'message' => count($movies) ? $movies : 'Nenhum Filme/Série cadastrado'
            ];
        } catch (\Throwable $th) {
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }
    }

    public function create(array $request): array
    {
        try {
            $params = ValidateService::rectifyParams($request);
            $returnValidate = ValidateService::paramsCreateMovie($params);
            if ($returnValidate['error']) {
                throw new Exception($returnValidate['message']);
            }

            if (MovieRepo::create($params) === false) {
                throw new Exception("Erro ao salvar Filme ou Série");
            }

            return [
                'error' => false,
                'message' => 'Filme ou Série criado com sucesso'
            ];
        } catch (\Throwable $th) {
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }
    }

    public function show(array $request): array
    {
        try {
            $params = ValidateService::paramsFilterData($request);
            if ($params['error']) {
                throw new Exception($params['message']);
            }

            $returnDatas = MovieRepo::getJoinGenreTypeVote($params['condition']);
            if ($returnDatas === false) {
                throw new Exception("Erro ao buscar os Filmes/Séries. Por favor tente mais tarde");
            }

            return [
                'error' => false,
                'message' => count($returnDatas) ? $returnDatas : 'Nenhum Filme/Série encontrado'
            ];
        } catch (\Throwable $th) {
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }
    }

    public function update(array $request, $id): array
    {
        try {
            if (empty(trim($id))) {
                throw new Exception("Necessário fornecer o ID do Filme/Série");
            }

            $params = ValidateService::rectifyParams($request);
            $returnValidate = ValidateService::paramsUpdateMovie($params, $id);
            if ($returnValidate['error']) {
                throw new Exception($returnValidate['message']);
            }

            if (MovieRepo::update($id, $params) === false) {
                throw new Exception("Erro ao atualizar Filme ou Série");
            }

            return [
                'error' => false,
                'message' => 'Atualização realizada com sucesso'
            ];
        } catch (\Throwable $th) {
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }
    }

    public function destroy($id)
    {
        try {
            if (empty(trim($id))) {
                throw new Exception("Necessário fornecer o ID do Filme/Série");
            }

            $returnMovie = Movie::where('id', $id)->get();
            if ($returnMovie === false) {
                throw new Exception("Erro ao buscar o Filme/Série. Por favor tente mais tarde");
            }
            if (!count($returnMovie)) {
                throw new Exception("Filme/Série inexistente");
            }

            if (!Movie::destroy($id)) {
                throw new Exception("Erro ao deletar Filme/Série");
            }

            return [
                'error' => false,
                'message' => 'Filme/Série deletado com sucesso'
            ];
        } catch (\Throwable $th) {
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }
    }
}
