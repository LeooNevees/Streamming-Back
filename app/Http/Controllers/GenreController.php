<?php

namespace App\Http\Controllers;

use App\Services\GenreService;
use Exception;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $returnGenre = (new GenreService)->index();
            if ($returnGenre['error'] == true) {
                throw new Exception($returnGenre['message'], 400);
            }

            return response(['error' => false, 'message' => $returnGenre['message']], 200);
        } catch (\Throwable $th) {
            return response(['error' => true, 'message' => $th->getMessage()], $th->getCode());
        }
    }

}
