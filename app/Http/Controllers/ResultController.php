<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserQuestion;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    //
    public function getResult()
    {
        $results = UserQuestion::where('user_id', Auth::user()->id)->get();
        $calculatedResults = $this->calculateResult($results);

        return view('student/result/dashboard')->with('result', $calculatedResults);
    }

    public function calculateResult($results)
    {
        $counter = 0;
        foreach ($results as $result) 
        {
            $question = Question::find($result->question_id);
            if (strtolower($result->user_answer) == strtolower($question->correct_answer)) 
            {
                $counter++;
            }
        }

        return $counter;
    }

    public function getResultStudents()
    {
        $resultsStudents = UserQuestion::orderby('user_id')->orderby('question_id')->get();
        $combinedResults = collect();
        foreach ($resultsStudents as $resultStudent) 
        {
            $question = Question::find($resultStudent->question_id);
            $user = User::find($resultStudent->user_id);
            if($question && $user){
                $combinedResults->push([
                    'question' => $question->question,
                    'correct_answer' => $question->correct_answer,
                    'user' => $user->name,
                    'user_answer' => $resultStudent->user_answer,
                ]);
            }
        }

        return view('teacher/result/dashboard', ['resultsStudents' => $combinedResults]);
    }
}
