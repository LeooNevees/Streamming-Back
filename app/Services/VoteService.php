<?php

namespace App\Services;

use App\Models\Vote;
use App\Repository\VoteRepo;
use Exception;
use Illuminate\Support\Facades\Auth;

class VoteService
{
    protected $user;

    public function __construct()
    {
        $user = Auth::user();
        $this->user = $user->id;
    }

    public function create(array $request): array
    {
        try {
            $params = ValidateService::rectifyParams($request);
            $params['users_id'] = $this->user;

            $returnValidate = ValidateService::paramsCreateVote($params);
            if ($returnValidate['error']) {
                throw new Exception($returnValidate['message']);
            }

            if (VoteRepo::create($params) === false) {
                throw new Exception("Erro ao salvar Votação");
            }

            return [
                'error' => false,
                'message' => 'Votação salvo com sucesso'
            ];
        } catch (\Throwable $th) {
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }
    }

    public function destroy()
    {
        try {
            $user = $this->user;
            $returnVote = Vote::where('users_id', $user)->get();
            if ($returnVote === false) {
                throw new Exception("Erro ao buscar a Votação. Por favor tente mais tarde");
            }
            if (!count($returnVote)) {
                throw new Exception("Votação inexistente");
            }

            if (!Vote::where('users_id', $user)->delete()) {
                throw new Exception("Erro ao deletar Votação");
            }

            return [
                'error' => false,
                'message' => 'Votação deletada com sucesso'
            ];
        } catch (\Throwable $th) {
            return [
                'error' => true,
                'message' => $th->getMessage()
            ];
        }
    }
}
