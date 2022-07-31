<?php

namespace App\Services;

use App\Models\ImageMovie;
use App\Models\Movie;
use App\Models\Vote;
use App\Repository\MovieRepo;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

            DB::beginTransaction();

            $returnMovie = MovieRepo::create($params);
            if ($returnMovie === false) {
                throw new Exception("Erro ao salvar Filme/Série");
            }

            $params['movie_id'] = $returnMovie->id;
            if (isset($params['image']) && !empty($params['image'])) {
                $params['path_image'] = $request['image']->store('movies');
                if (MovieRepo::createImage($params) === false) {
                    throw new Exception("Erro ao salvar Imagem do Filme/Série");
                }
            }

            DB::commit();

            return [
                'error' => false,
                'message' => 'Filme ou Série criado com sucesso'
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }
    }

    public function show(array $request): array
    {
        try {
            $params = ValidateService::rectifyParams($request);

            $returnDatas = match (true) {
                isset($params['description']) => MovieRepo::getMoviesWithDescription($params['description']),
                isset($params['id']) => MovieRepo::getMoviesWithWhere([['id', $params['id']]]),
                default => MovieRepo::getMoviesWithWhere([]),
            };
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

    public function image(int $id): array
    {
        try {
            $returnDatas = ImageMovie::where('movie_id', $id)
                ->where('situation', 'A')
                ->get();
            if ($returnDatas === false) {
                throw new Exception("Erro ao buscar os Filmes/Séries. Por favor tente mais tarde");
            }

            return [
                'error' => false,
                'image' => count($returnDatas) ? 'app/' . $returnDatas[0]->path_image : 'app/movies/notFound.png'
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

            DB::beginTransaction();

            $returnImage = ImageMovie::where('movie_id', $id)->get();
            if ($returnImage === false) {
                throw new Exception("Erro ao encontrar Imagem do Filme");
            }

            if (count($returnImage)) {
                if (ImageMovie::destroy($returnImage[0]->id) === false) {
                    throw new Exception("Erro ao deletar Imagem do Filme");
                }
                Storage::disk('local')->delete($returnImage[0]->path_image);
            }

            if(Vote::where('movie_id', $id)->delete() === false) {
                throw new Exception("Erro ao delete votação para Filme");
            }

            if (Movie::destroy($id) === false) {
                throw new Exception("Erro ao deletar Filme/Série");
            }

            DB::commit();
            return [
                'error' => false,
                'message' => 'Filme/Série deletado com sucesso'
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }
    }
}
