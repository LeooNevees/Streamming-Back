<?php

namespace App\Services;

use App\Models\Genre;
use Exception;

class GenreService
{
    public function index(): array
    {
        try {
            $genres = Genre::where('situation', 'A')->select('id', 'name')->get();
            if ($genres === false) {
                throw new Exception("Erro ao buscar Gêneros. Por favor tente novamente mais tarde");
            }

            return [
                'error' => false,
                'message' => count($genres) ? $genres : 'Nenhum Gênero cadastrado'
            ];
        } catch (\Throwable $th) {
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }
    }
}
