<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Question;

class FetchQuestions extends Command
{
    protected $signature = 'fetch:questions';
    protected $description = 'Fetch questions from the API and store them in the database';

    public function handle()
    {
        $response = Http::withOptions(['verify' => false])->get('https://opentdb.com/api.php?amount=50&type=multiple');

        if ($response->successful()) {
            $questions = $response->json()['results'];

            foreach ($questions as $apiQuestion) {
                $options = [
                    'option_a' => html_entity_decode($apiQuestion['incorrect_answers'][0]),
                    'option_b' => html_entity_decode($apiQuestion['incorrect_answers'][1]),
                    'option_c' => html_entity_decode($apiQuestion['incorrect_answers'][2]),
                ];

                $correctOptionKey = array_rand($options);
                $options[$correctOptionKey] = html_entity_decode($apiQuestion['correct_answer']);

                Question::create([
                    'question' => html_entity_decode($apiQuestion['question']),
                    'option_a' => $options['option_a'],
                    'option_b' => $options['option_b'],
                    'option_c' => $options['option_c'],
                    'correct_option' => $correctOptionKey,
                    'media_url' => null,
                ]);
            }

            $this->info('Questions fetched and stored successfully.');
        } else {
            $this->error('Failed to fetch questions from the API.');
        }
    }
}
