<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserQuestion;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    //
    public function getResult()
    {
        $results = UserQuestion::where('user_id', Auth::user()->id)->get();
        $calculatedResults = $this->calculateResult($results);

        return view('student/result/dashboard')->with('results', $calculatedResults);
    }

    public function calculateResult($results)
    {
        $counter = 0;
        foreach ($results as $result) 
        {
            if ($result->user_answer == $result->questions->correct_answer) 
            {
                $counter++;
            }
        }

        return $counter;
    }

    public function getResultStudents()
    {
        $resultsStudents = UserQuestion::orderby('user_id')->orderby('question_id')->get();

        return view('teacher/result/dashboard')->with('resultsStudents', $resultsStudents);
    }
}
