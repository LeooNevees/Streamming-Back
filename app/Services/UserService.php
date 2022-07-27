<?php

namespace App\Services;

use App\Models\Movie;
use App\Models\User;
use App\Repository\MovieRepo;
use Exception;

class UserService
{

    public function create(array $request): array
    {
        try {
            $returnValidate = ValidateService::paramsCreateUser($request);
            if ($returnValidate['error']) {
                throw new Exception($returnValidate['message']);
            }

            if (User::create($returnValidate['params']) === false) {
                throw new Exception("Erro ao salvar Usuário. Por favor refaça o procedimento");
            }

            return [
                'error' => false,
                'message' => 'Usuário cadastrado com sucesso'
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
                throw new Exception("Necessário fornecer o ID do Usuário");
            }

            $returnUser = User::where('id', $id)->get();
            if ($returnUser === false) {
                throw new Exception("Erro ao buscar o Usuário. Por favor tente mais tarde");
            }
            if (!count($returnUser)) {
                throw new Exception("Usuário inexistente");
            }

            if (!User::destroy($id)) {
                throw new Exception("Erro ao deletar Usuário");
            }

            return [
                'error' => false,
                'message' => 'Usuário deletado com sucesso'
            ];
        } catch (\Throwable $th) {
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }
    }
}
