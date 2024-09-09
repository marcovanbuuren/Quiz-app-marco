<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vragen dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('question.create.teacher') }}">Vraag aanmaken</a>
                </div>
            </div>
        </div>
    </div>

    <table>
        <th>Vraag</th>
        <th>Optie 1</th>
        <th>Optie 2</th>
        <th>optie 3</th>
        <th>Correct antwoord</th>
        <th>Aanpassen</th>
        @foreach ($questions as $question)
            <tr>
                <td>{{ $question->question }}</td>
                <td>{{ $question->option_1 }}</td>
                <td>{{ $question->option_2 }}</td>
                <td>{{ $question->option_3 }}</td>
                <td>{{ $question->correct_answer }}</td>
                <td>
                    <form action="{{ route('question.edit.teacher', $question->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $question->id }}">
                        <button type="submit">Aanpassen</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</x-app-layout>