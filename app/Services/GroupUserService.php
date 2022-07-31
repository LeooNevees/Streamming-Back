<?php

namespace App\Services;

use App\Models\GroupUser;
use Exception;

class GroupUserService
{
    public function index(): array
    {
        try {
            $groups = GroupUser::where('situation', 'A')->select('id', 'name')->get();
            if ($groups === false) {
                throw new Exception("Erro ao buscar os Grupos de Usuários. Por favor tente novamente mais tarde");
            }

            return [
                'error' => false,
                'message' => count($groups) ? $groups : 'Nenhum Grupo cadastrado'
            ];
        } catch (\Throwable $th) {
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }
    }
}
