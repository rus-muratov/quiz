<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionsRequest;
use Illuminate\Support\Facades\Http;
use App\Models\SearchHistory;

class QuizController extends Controller
{


    public function fetchQuestions(QuestionsRequest $request)
    {
        $questionsData = $this->fetchData($request);

        if (is_null($questionsData)) {
            return back()->with('error', 'Failed to fetch questions data.');
        }

        SearchHistory::create($request->validated());

        $data = $this->sortAndFilterQuestions($questionsData);

        return view('quiz', ['data' => $data]);
    }

    private function fetchData($request)
    {
        $response = Http::get('https://opentdb.com/api.php', [
            'amount' => $request->amount,
            'difficulty' => $request->difficulty,
            'type' => $request->type
        ]);

        return $response->successful() ? $response->json()['results'] : null;
    }

    private function sortAndFilterQuestions($questionsData)
    {
        $data = collect($questionsData);
        $filteredData = $data->reject(function ($question) {
            return $question['category'] === "Entertainment: Video Games";
        });

        return $filteredData->sortBy('category')->values()->all();
    }

}
