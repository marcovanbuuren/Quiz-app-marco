<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('resultaat') }}
        </h2>
    </x-slot>

    <div class="result">
        <p>Jouw resultaat is: {{ $result }} </p>
    </div>
</x-app-layout>
