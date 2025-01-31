<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Answer;

class AnswerController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'game_id' => 'required|integer',
            'question_id' => 'required|integer',
            'selected_option' => 'required|string',
            'is_correct' => 'required|boolean',
            'duration' => 'required|integer',
             // Añadir validación para selected_option
        ]);

        $answer = Answer::create($validatedData);

        return response()->json($answer, 201);
    }
}
