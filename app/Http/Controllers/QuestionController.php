<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\UserQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    //
    public function getAllQuestions()
    {
        $questions = Question::all();

        return view('teacher.question.dashboard')->with('questions', $questions);
    }

    public function getQuestion()
    {
        $questionsAnsweredIdUser = UserQuestion::where('user_id', Auth::user()->id)->pluck('question_id')->toArray();
        $questions = null;

        if (count($questionsAnsweredIdUser) < 1)
        {
            $questions = Question::all();
        }
        else 
        {
            $questions = Question::whereNot('id', $questionsAnsweredIdUser)->get();
        }
        if (count($questions) == 1)
        {
            foreach ($questions as $question) {
                return view('student.question.dashboard')->with('question', $question);
            }
        }
        $getRandomInt = rand(0, count($questions));
        $counter = 0;

        foreach ($questions as $question) {
            if ($counter == $getRandomInt) {
                return view('student.question.dashboard')->with('question', $question);
            }
            $counter++;
        }
    }

    public function create()
    {
        return view('teacher/question/create');
    }

    public function edit(Request $request)
    {
        $question = Question::where('id', $request->id)->first();

        return view('teacher/question/edit')->with('question', $question);
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'option_1' => 'required|string',
            'option_2' => 'required|string',
            'option_3' => 'required|string',
            'correct_answer' => 'required|string|in:' . implode(',', [$request->option_1,$request->option_2,$request->option_3]) . '|max:255',
        ]);

        $isRunning = true;
        $randomStringForId = "";

        while ($isRunning) {
            $length = rand(3, 100);
            $randomStringForId = Str::random($length);
            $result = Question::where('id', $randomStringForId)->exists();
            if (!$result) {
                $isRunning = false;
            }
        }

        $question = new Question();
        $question->id = $randomStringForId;
        $question->question = $request->question;
        $question->option_1 = $request->option_1;
        $question->option_2 = $request->option_2;
        $question->option_3 = $request->option_3;
        $question->correct_answer = $request->correct_answer;
        $question->save();

        return redirect()->route('question.all.teacher');
    }

    public function update(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'option_1' => 'required|string',
            'option_2' => 'required|string',
            'option_3' => 'required|string',
            'correct_answer' => 'required|string|in:' . implode(',', [$request->option_1,$request->option_2,$request->option_3]) . '|max:255',
        ]);

        $question = Question::where('id', $request->id)->first();

        $question->question = $request->question;
        $question->option_1 = $request->option_1;
        $question->option_2 = $request->option_2;
        $question->option_3 = $request->option_3;
        $question->correct_answer = $request->correct_answer;
        $question->save();

        return redirect()->route('question.all.teacher');
    }

    public function destroy(Request $request)
    {
        $question = Question::where('id', $request->id)->first();
        $question->delete();
        return redirect()->route('question.all.teacher');
    }
}
