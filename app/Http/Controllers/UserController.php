<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Register User.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(UserRequest $request)
    {
        try {
            $returnUser = (new UserService)->register($request->all());
            if ($returnUser['error'] == true) {
                throw new Exception($returnUser['message'], 422);
            }

            return response()->json($returnUser, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => $th->getMessage()], $th->getCode());
        }
    }

    /**
     * Validation Login
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            $returnUser = (new UserService)->login($request->all());
            if ($returnUser['error'] == true) {
                throw new Exception($returnUser['message'], 401);
            }

            return response()->json($returnUser, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => $th->getMessage()], $th->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $returnUser = (new UserService)->destroy($id);
            if ($returnUser['error'] == true) {
                throw new Exception($returnUser['message'], 422);
            }

            return response()->json($returnUser, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => $th->getMessage()], $th->getCode());
        }
    }

    public function refresh()
    {
        try {
            return response()->json([
                'error' => 'false',
                'message' => 'Realizado geração de novo Token',
                'authorization' => [
                    'token' => Auth::refresh(),
                    'type' => 'bearer',
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => $th->getMessage()], $th->getCode());
        }
    }

    public function logout()
    {
        try {
            Auth::logout();
            return response()->json([
                'error' => 'false',
                'message' => 'Logout realizado com sucesso',
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => $th->getMessage()], $th->getCode());
        }
    }

    public function show()
    {
        try {
            $returnUser = (new UserService)->show();
            if($returnUser['error']){
                throw new Exception($returnUser['message'], 422);
            }

            return response()->json($returnUser, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => $th->getMessage()], $th->getCode());
        }
    }
}
