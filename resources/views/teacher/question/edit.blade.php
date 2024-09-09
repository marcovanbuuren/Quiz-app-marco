<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vraag aanpassen / verwijderen') }}
        </h2>
    </x-slot>

    <form action="{{ route('question.update.teacher') }}" method="post">
    @csrf
    @method('patch')

    <div class="form-group">
        <label for="question">Vraag</label>
        <input type="text" name="question" value="{{ $question->question }}">
    </div>
    <div class="form-group">
        <label for="option_1">Optie 1</label>
        <input type="text" name="option_1" value="{{ $question->option_1 }}">
    </div>
    <div class="form-group">
        <label for="option_2">Option 2</label>
        <input type="text" name="option_2" value="{{ $question->option_2 }}">
    </div>
    <div class="form-group">
        <label for="option_3">Optie 3</label>
        <input type="text" name="option_3" value="{{ $question->option_3 }}">
    </div>
    <div class="form-group">
        <label for="correct_answer">Correct antwoord</label>
        <input type="text" name="correct_answer" value="{{ $question->correct_answer }}">
    </div>

    <input type="hidden" name="id" value="{{ $question->id }}">

    <button type="submit">Aanpassen</button>
    </form>
    <form action="{{ route('question.delete.teacher') }}" method="post">
    @csrf
    @method('delete')

    <input type="hidden" name="id" value="{{ $question->id }}">

    <button type="submit">Verwijderen</button>
</x-app-layout>
