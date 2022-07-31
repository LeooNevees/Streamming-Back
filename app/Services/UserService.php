<?php

namespace App\Services;

use App\Models\Movie;
use App\Models\User;
use App\Models\Vote;
use App\Repository\MovieRepo;
use App\Repository\UserRepo;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class UserService
{

    public function register(array $request): array
    {
        try {
            $returnValidate = ValidateService::paramsCreateUser($request);
            if ($returnValidate['error']) {
                throw new Exception($returnValidate['message']);
            }

            $user = UserRepo::create($returnValidate['params']);

            $token = JWTAuth::fromUser($user);
            return [
                'error' => false,
                'message' => 'Usuário cadastrado com sucesso',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'group' => $user->group_user_id,
                ],
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ];
        } catch (\Throwable $th) {
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }
    }

    public function login(array $params): array
    {
        try {
            $token = JWTAuth::attempt($params);

            if (!$token) {
                throw new Exception("Não autorizado");
            }

            $user = Auth::user();
            return [
                'error' => false,
                'message' => 'Usuário autenticado com sucesso',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'group' => $user->group_user_id
                ],
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
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

            $returnValidate = ValidateService::paramsDeleteUser($id);
            if($returnValidate['error']){
                throw new Exception($returnValidate['message']);
            }

            DB::beginTransaction();
            if (Vote::where('users_id', $id)->delete() === false) {
                throw new Exception("Erro ao deletar os votos do usuários");
            }

            if (!User::destroy($id)) {
                throw new Exception("Erro ao deletar Usuário");
            }
            DB::commit();

            return [
                'error' => false,
                'message' => 'Usuário deletado com sucesso'
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }
    }

    public function show()
    {
        try {
            $users = UserRepo::show();
            if ($users === false) {
                throw new Exception("Erro ao buscar os Usuários. Por favor tente mais tarde");
            }

            return [
                'error' => false,
                'message' => count($users) ? $users : 'Nenhum Usuário cadastrado'
            ];
        } catch (\Throwable $th) {
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }
    }
}
