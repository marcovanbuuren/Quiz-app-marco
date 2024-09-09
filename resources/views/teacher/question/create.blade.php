<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vraag aanmaken') }}
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

    <form action="{{ route('question.store.teacher') }}" method="post">
    @csrf
    @method('put')

    <div class="form-group">
        <label for="question">Vraag</label>
        <input type="text" name="question">
    </div>
    <div class="form-group">
        <label for="option_1">Optie 1</label>
        <input type="text" name="option_1">
    </div>
    <div class="form-group">
        <label for="option_2">Option 2</label>
        <input type="text" name="option_2">
    </div>
    <div class="form-group">
        <label for="option_3">Optie 3</label>
        <input type="text" name="option_3">
    </div>
    <div class="form-group">
        <label for="correct_answer">Correct antwoord</label>
        <input type="text" name="correct_answer">
    </div>

    <button type="submit">Verzenden</button>
    </form>
</x-app-layout>
