<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoteRequest;
use App\Services\VoteService;
use Exception;

class VoteController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(VoteRequest $request)
    {
        try {
            $returnVote = (new VoteService)->create($request->all());
            if ($returnVote['error'] == true) {
                throw new Exception($returnVote['message'], 422);
            }

            return response()->json($returnVote, 201);
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
    public function destroy()
    {
        try {
            $returnVote = (new VoteService)->destroy();
            if ($returnVote['error'] == true) {
                throw new Exception($returnVote['message'], 422);
            }

            return response()->json($returnVote, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => $th->getMessage()], $th->getCode());
        }
    }
}
