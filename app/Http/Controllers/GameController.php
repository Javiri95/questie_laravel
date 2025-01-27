<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Game;

use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'score' => 'required|integer',
            'date' => 'required|date',
        ]);

        $game = Game::create([
            'user_id' => $request->user()->id,
            'score' => $validatedData['score'],
            'date' => $validatedData['date'],
        ]);

        return response()->json($game);
    }
}
