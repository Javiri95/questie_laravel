<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    
    // [app/Http/Controllers/QuestionController.php]

    public function getRandomQuestions()
    {
        $questions = Question::inRandomOrder()->limit(10)->get();
        return response()->json($questions);
    }

    public function index()
    {
        // Usa paginación para obtener las preguntas
        $questions = Question::paginate(25);

        // Pasa las preguntas a la vista
        return view('admin-page', compact('questions'));
    }

    public function indexReact(Request $request)
    {
        // Filtrar preguntas por estado (por defecto 'aprobada' si no se pasa)
        $query = Question::query();

        // Filtrar por 'estado' si se pasa como parámetro
        if ($request->has('estado')) {
            $query->where('estado', $request->estado);
        }

        // Filtrar por 'categoria' si se pasa como parámetro
        if ($request->has('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        // Obtener las preguntas filtradas
        $questions = $query->get();

        // Devolver las preguntas como respuesta JSON
        return response()->json($questions);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'option_a' => 'required|string|max:255',
            'option_b' => 'required|string|max:255',
            'option_c' => 'required|string|max:255',
            'correct_option' => 'required|string|max:255',
            'media_url' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-page')
                ->withErrors($validator)
                ->withInput();
        }

        Question::create($request->all());

        return redirect()->route('admin-page')->with('success', 'Pregunta añadida correctamente');
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('questions.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $question->update($request->all());
        return redirect()->route('admin-page')->with('success', 'Pregunta actualizada correctamente');
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect()->route('admin-page')->with('success', 'Pregunta eliminada correctamente');
    }
}