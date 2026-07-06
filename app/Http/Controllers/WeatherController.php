<?php

namespace App\Http\Controllers;

use App\Services\WeatherService as WeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function __construct(private readonly WeatherService $weatherService) {}

    public function index(Request $request)
    {
        $city = trim($request->input('city', ''));
        $weather = null;
        $error = null;

        if ($city !== '') {
            try {
                $weather = $this->weatherService->getWeather($city);
            } catch (\Throwable $e) {
                $error = $e->getMessage();
            }
        }

        return view('weather', compact('city', 'weather', 'error'));
    }
}
