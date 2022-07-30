<?php

namespace App\Http\Controllers;

use App\Services\TypeEntertainmentService;
use Exception;
use Illuminate\Http\Request;

class TypeEntertainmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $returnTypes = (new TypeEntertainmentService)->index();
            if ($returnTypes['error'] == true) {
                throw new Exception($returnTypes['message'], 400);
            }

            return response(['error' => false, 'message' => $returnTypes['message']], 200);
        } catch (\Throwable $th) {
            return response(['error' => true, 'message' => $th->getMessage()], $th->getCode());
        }
    }
}
