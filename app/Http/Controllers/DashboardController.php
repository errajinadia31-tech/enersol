<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Models\Panel;
use App\Models\EnergyData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller 
{public function index()
{
    $user = Auth::user();

    // 1. كنجيبو آخر لوح زادو المستخدم باش نعرفو المدينة ديالو بالظبط
    $latestPanel = Panel::where('user_id', $user->id)
                        ->with('zone')
                        ->latest()
                        ->first();

    // تحديد المدينة: كنقلبو فـ خانة 'city' لي فجدول zones
    if ($latestPanel && $latestPanel->zone && $latestPanel->zone->city) {
        $city = $latestPanel->zone->city; 
    } else {
        // إلا مالقاش لوح، كيشوف آخر منطقة واش فيها مدينة
        $latestZone = $user->zones()->latest()->first();
        $city = ($latestZone && $latestZone->city) ? $latestZone->city : "Oujda";
    }

    // --- 2. Weather API ---
    $apiKey = env('OPENWEATHER_API_KEY');
    $weather = null;

    try {
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric',
            'lang' => 'fr'
        ]);
        
        if ($response->successful()) {
            $weather = $response->json();
        } else {
            $fallback = Http::get("https://api.openweathermap.org/data/2.5/weather", [
                'q' => 'Casablanca',
                'appid' => $apiKey,
                'units' => 'metric',
                'lang' => 'fr'
            ]);
            $weather = $fallback->json();
        }
    } catch (\Exception $e) {
        $weather = null;
    }

    // --- 3. بيانات الطاقة ---
    $zones = $user->zones()->with('panels')->get();
    $userPanelIds = Panel::where('user_id', $user->id)->pluck('id');

    $totalEnergyToday = EnergyData::whereIn('panel_id', $userPanelIds)
                                    ->whereDate('created_at', today())
                                    ->sum('power');

    $activePanelsCount = Panel::where('user_id', $user->id)
                                  ->where('status', 'active')
                                  ->count();

    $latestReadings = EnergyData::whereIn('panel_id', $userPanelIds)
                                    ->with('panel')
                                    ->latest()
                                    ->take(10)
                                    ->get();

    return view('dashboard', compact('zones', 'totalEnergyToday', 'activePanelsCount', 'latestReadings', 'weather'));
}

public function Statistiques()
{
    // Simulation de données pour les 10 dernières minutes
    $latestData = collect();
    for ($i = 10; $i >= 0; $i--) {
        $voltage = rand(218, 225); // Tension stable autour de 220V
        $current = rand(1, 5) + (rand(0, 9) / 10); // Courant entre 1.0A et 5.9A
        
        $latestData->push((object)[
            'created_at' => now()->subMinutes($i),
            'voltage' => $voltage,
            'current' => $current,
            'power' => round($voltage * $current, 2)
        ]);
    }

    // On passe ces données à la vue
    return view('statistiques.statistique', [
        'latestData' => $latestData->reverse() // Pour avoir la plus récente en haut
    ]);
}
}