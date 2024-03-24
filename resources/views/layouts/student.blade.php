<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EHU Timetabler') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Copse&family=Fauna+One&family=Inter:wght@100..900&display=swap"
          rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-slate-50">
    @include('layouts.navigation-student')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="font-copse text-4xl max-w-7xl mx-auto m-10 py-6 px-4 sm:px-6 lg:px-8">
            <h1>{{ $header }}</h1>
        </header>
    @endif

    <div>

{{--        <x-text-input wire:key="student" wire:model.live="student" class="w-full sm:w-1/3 lg:w-2/3 text-black block m-auto border-ehu-pink border-4" digits="8" type="text" placeholder="Enter your student ID!..."></x-text-input>--}}
<input type="text" wire:mode.live="student">

    <livewire:get-student-details />
    </div>
</div>
</body>
</html>
