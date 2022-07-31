<?php

namespace App\Http\Controllers;

use App\Services\GroupUserService;
use Exception;

class GroupUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $returnGroups = (new GroupUserService)->index();
            if ($returnGroups['error'] == true) {
                throw new Exception($returnGroups['message'], 422);
            }

            return response()->json($returnGroups, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => $th->getMessage()], $th->getCode());
        }
    }
}
