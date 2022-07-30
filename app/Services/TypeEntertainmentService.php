<?php

namespace App\Services;

use App\Models\TypeEntertainment;
use Exception;

class TypeEntertainmentService
{
    public function index(): array
    {
        try {
            $types = TypeEntertainment::where('situation', 'A')->get();
            if ($types === false) {
                throw new Exception("Erro ao Tipo de Entretenimento. Por favor tente novamente mais tarde");
            }

            return [
                'error' => false,
                'message' => count($types) ? $types : 'Nenhum Tipo de Entretenimento cadastrado'
            ];
        } catch (\Throwable $th) {
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }
    }
}
