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
    $latestPanel = \App\Models\Panel::where('user_id', $user->id)
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
            // إلا فشل فـ جلب الطقس ديال المدينة لي دخل user، كنرجعو لـ Oujda كديفو
            $fallback = Http::get("https://api.openweathermap.org/data/2.5/weather", [
                'q' => 'Oujda',
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
    $userPanelIds = \App\Models\Panel::where('user_id', $user->id)->pluck('id');

    $totalEnergyToday = \App\Models\EnergyData::whereIn('panel_id', $userPanelIds)
                                    ->whereDate('created_at', today())
                                    ->sum('power');

    $activePanelsCount = \App\Models\Panel::where('user_id', $user->id)
                                  ->where('status', 'active')
                                  ->count();

    $latestReadings = \App\Models\EnergyData::whereIn('panel_id', $userPanelIds)
                                    ->with('panel')
                                    ->latest()
                                    ->take(10)
                                    ->get();

    return view('dashboard', compact('zones', 'totalEnergyToday', 'activePanelsCount', 'latestReadings', 'weather'));
}
}