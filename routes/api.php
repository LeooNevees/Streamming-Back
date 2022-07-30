<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TypeEntertainmentController;
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

    // Route::get('/', [MovieController::class, 'index']);

    Route::get('/show', [MovieController::class, 'show']);

    Route::get('/image/{id}', [MovieController::class, 'image']);

    Route::post('/create', [MovieController::class, 'create']);

    Route::put('/update/{id}', [MovieController::class, 'update']);

    Route::delete('/destroy/{id}', [MovieController::class, 'destroy']);
});

/* End Points - Votação */
Route::group(['prefix' => 'genre'], function () {

    Route::get('/', [GenreController::class, 'index']);
});

/* End Points - Votação */
Route::group(['prefix' => 'typeEntertainment'], function () {

    Route::get('/', [TypeEntertainmentController::class, 'index']);
});

/* End Points - Votação */
Route::group(['prefix' => 'vote'], function () {

    Route::post('/create', [VoteController::class, 'create']);

    Route::delete('/destroy/{id}', [VoteController::class, 'destroy']);
});
