<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


/* End Points - Usuários */
Route::group(['prefix' => 'user'], function () {

    Route::post('/register', [UserController::class, 'register']);

    Route::post('/auth', [UserController::class, 'auth']);

    Route::delete('/destroy/{id}', [UserController::class, 'destroy']);
});

/* End Points - Filmes e Séries */
Route::group(['prefix' => 'movies'], function () {

    Route::get('/', [MovieController::class, 'index']);

    Route::get('/show', [MovieController::class, 'show']);

    Route::post('/create', [MovieController::class, 'create']);

    Route::put('/update/{id}', [MovieController::class, 'update']);

    Route::delete('/destroy/{id}', [MovieController::class, 'destroy']);
});

/* End Points - Votação */
Route::group(['prefix' => 'vote'], function () {

    Route::post('/create', [VoteController::class, 'create']);

    Route::delete('/destroy/{id}', [VoteController::class, 'destroy']);
});
