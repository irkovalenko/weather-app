<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Weather') }}</title>

    @fonts

    <!-- Styles / Scripts -->
    @if (true)
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif
</head>

<body class="bg-[#101930] text-white flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        Weather App
    </header>

    <h1>Weather App</h1>

    <div class="mt-6">
        <form method="GET" action="{{ route('weather.index') }}" class="flex flex-col gap-4">
            <input type="text" name="city" id="city" value="{{ $city }}" placeholder="Enter city name" class="border border-gray-300 rounded px-4 py-2">
            <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2">Get Weather</button>
        </form>

        @if ($error)
        <div class="alert error">{{ $error }}</div>
        @elseif ($weather)
        <div class="mt-6 p-4 bg-gray-800 rounded">
            <h2>{{ $weather['message'] }}</h2>
            <div class="mt-6 items-center flex gap-2">
                <x-lucide-map-pin class="w-6 h-6 text-violet-500" />
                <p><strong>City:</strong> {{ $weather['city'] }}</p>
            </div>
            <div class="mt-6 items-center flex gap-2">
                <x-lucide-thermometer-sun class="w-6 h-6 text-red-500" />
                <p><strong>Temperature:</strong> {{ $weather['temperature'] }}°C</p>
            </div>
            <div class="mt-6 items-center flex gap-2">
                <x-lucide-cloud class="w-6 h-6 text-gray-500" />
                <p><strong>Description:</strong> {{ $weather['description'] }}</p>
            </div>
            <div class="mt-6 items-center flex gap-2">
                <x-lucide-droplets class=" w-6 h-6 text-blue-500" />
                <p><strong>Humidity:</strong> {{ $weather['humidity'] }}%</p>
            </div>
        </div>
        @endif
    </div>
</body>

</html>