<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Answer;

class AnswerController extends Controller
{
    public function store(Request $request)
{
    $answer = Answer::create($request->all());
    return response()->json($answer);
}
}
