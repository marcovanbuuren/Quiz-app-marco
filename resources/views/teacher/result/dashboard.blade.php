<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Studenten resultaten') }}
        </h2>
    </x-slot>

    <table>
        <tr>
            <th>Vraag</th>
            <th>Student</th>
            <th>Antwoord student</th>
            <th>Correct antwoord</th>
        </tr>
        @foreach ($resultsStudents as $resultStudent)
            <tr>
                <td>{{ $resultStudent['question'] }}</td>
                <td>{{ $resultStudent['user'] }}</td>
                <td>{{ $resultStudent['user_answer'] }}</td>
                <td>{{ $resultStudent['correct_answer'] }}</td>
            </tr>
        @endforeach
    </table>
</x-app-layout>
