<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Antwoord vergelijking') }}
        </h2>
    </x-slot>

    @if ($evaluated_answer == true)
        <div class="good-answer">
            <table>
                <tr>
                    <th>Jouw antwoord</th>
                    <th>Correct antwoord</th>
                </tr>
                <tr>
                    <td>{{ $correct_answer }}</td>
                    <td>{{ $user_answer }}</td>
                </tr>
            </table>
            <a href="{{ route('question.get.student') }}">Volgende vraag</a>
        </div>
    @else
        <div class="fault-answer">
            <table>
                <tr>
                    <th>Jouw antwoord</th>
                    <th>Correct antwoord</th>
                </tr>
                <tr>
                    <td>{{ $correct_answer }}</td>
                    <td>{{ $user_answer }}</td>
                </tr>
            </table>
            <a href="{{ route('question.get.student') }}">Volgende vraag</a>
        </div>
    @endif
</x-app-layout>