<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vraag beantwoorden') }}
        </h2>
    </x-slot>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('answer.store.student') }}" method="post">
    @csrf

    <div class="form-group">
        <label for="question">Vraag</label>
        <p>{{ $question->question }}</p>
    </div>
    <div class="form-group">
        <label for="option_1">Optie 1</label>
        <p>{{ $question->option_1 }}</p>
    </div>
    <div class="form-group">
        <label for="option_2">Option 2</label>
        <p>{{ $question->option_2 }}</p>
    </div>
    <div class="form-group">
        <label for="option_3">Optie 3</label>
        <p>{{ $question->option_3 }}</p>
    </div>
    <div class="form-group">
        <label for="user_answer">Antwoord</label>
        <input type="text" name="user_answer">
    </div>

    <input type="hidden" name="question_id" value="{{ $question->id }}">

    <button type="submit">Verzenden</button>
    </form>
</x-app-layout>
