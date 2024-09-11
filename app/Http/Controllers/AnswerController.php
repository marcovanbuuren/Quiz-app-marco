<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\UserQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    //
    public function getAnswer($question_id)
    {
        $question = Question::where('id', $question_id)->first();
        return $question->correct_answer;
    }

    public function controlAnswer($user_answer, $correct_answer)
    {
        if ($user_answer == $correct_answer) 
        {
            return true;
        }
        else 
        {
            return false;
        }
    }

    public function storeAnswer(Request $request)
    {
        $request->validate([
            'user_answer' => 'required|string|max:255',
            'question_id' => 'required|string|max:255',
        ]);

        $correct_answer = $this->getAnswer($request->question_id);
        $evaluated_answer = $this->controlAnswer($request->user_answer, $correct_answer);

        $answer = new UserQuestion();
        $answer->question_id = $request->question_id;
        $answer->user_id = Auth::user()->id;
        $answer->user_answer = $request->user_answer;
        $answer->save();

        return view('student.answer.dashboard')->with('correct_answer', $correct_answer)->with('evaluated_answer', $evaluated_answer)->with('user_answer', $request->user_answer);
    }
}
