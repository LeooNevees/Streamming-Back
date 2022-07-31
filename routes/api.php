<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\GroupUserController;
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

/* End Points - Usuários */
Route::group(['prefix' => 'user'], function () {

    Route::post('/register', [UserController::class, 'register']);

    Route::post('/login', [UserController::class, 'login']);

    Route::get('/show', [UserController::class, 'show'])->middleware('auth:api');

    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:api');

    Route::post('/refresh', [UserController::class, 'refresh'])->middleware('auth:api');

    Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->middleware('auth:api');
});

/* End Points - Filmes e Séries */
Route::group(['prefix' => 'movies'], function () {

    Route::get('/show', [MovieController::class, 'show']);

    Route::get('/image/{id}', [MovieController::class, 'image']);

    Route::post('/create', [MovieController::class, 'create'])->middleware('auth:api');

    Route::put('/update/{id}', [MovieController::class, 'update'])->middleware('auth:api');

    Route::delete('/destroy/{id}', [MovieController::class, 'destroy'])->middleware('auth:api');
});

/* End Points - Gêneros */
Route::group(['prefix' => 'genre'], function () {

    Route::get('/', [GenreController::class, 'index']);
});

/* End Points - Tipos Entretenimento */
Route::group(['prefix' => 'typeEntertainment'], function () {

    Route::get('/', [TypeEntertainmentController::class, 'index']);
});

/* End Points - Grupos de Usuários */
Route::group(['prefix' => 'groups'], function () {

    Route::get('/', [GroupUserController::class, 'index']);
});

/* End Points - Votação */
Route::group(['prefix' => 'vote'], function () {

    Route::post('/create', [VoteController::class, 'create'])->middleware('auth:api');

    Route::delete('/destroy', [VoteController::class, 'destroy'])->middleware('auth:api');
});

