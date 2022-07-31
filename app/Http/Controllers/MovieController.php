<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Services\MovieService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $returnMovie = (new MovieService)->index();
            if ($returnMovie['error'] == true) {
                throw new Exception($returnMovie['message'], 400);
            }

            return response()->json($returnMovie, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => $th->getMessage()], $th->getCode());
        }
    }

    /**
     * Show the form for creatin1g a new resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(MovieRequest $request)
    {
        try {
            $returnMovie = (new MovieService)->create($request->all());
            if ($returnMovie['error'] == true) {
                throw new Exception($returnMovie['message'], 422);
            }

            return response()->json($returnMovie, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => $th->getMessage()], $th->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $returnData = (new MovieService)->show($request->all());
            if ($returnData['error'] == true) {
                throw new Exception($returnData['message'], 422);
            }

            return response()->json($returnData, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => $th->getMessage()], $th->getCode());
        }
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function image($id)
    {
        try {
            $returnData = (new MovieService)->image($id);
            Log::info($returnData);
            if ($returnData['error'] == true) {
                throw new Exception($returnData['message'], 422);
            }
            return response()->file(storage_path($returnData['image']));
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => $th->getMessage()], $th->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MovieRequest $request, $id)
    {
        try {
            $returnMovie = (new MovieService)->update($request->all(), $id);
            if ($returnMovie['error'] == true) {
                throw new Exception($returnMovie['message'], 422);
            }

            return response()->json($returnMovie, 201);
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
            $returnMovie = (new MovieService)->destroy($id);
            if ($returnMovie['error'] == true) {
                throw new Exception($returnMovie['message'], 422);
            }

            return response()->json($returnMovie, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => $th->getMessage()], $th->getCode());
        }
    }
}
