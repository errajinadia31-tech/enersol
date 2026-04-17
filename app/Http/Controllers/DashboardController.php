<?php

namespace App\Http\Controllers;

use App\Models\Panel;
use App\Models\EnergyData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        $totalPanels = Panel::where('user_id', $userId)->count();
        $totalPower = Panel::where('user_id', $userId)->sum('power_capacity');
        $activeZones = Panel::where('user_id', $userId)->distinct('zone_id')->count('zone_id');
        $maintenanceCount = Panel::where('user_id', $userId)
            ->where('status', 'maintenance')
            ->count();

        $latestPanel = Panel::where('user_id', $userId)
            ->with('zone')
            ->latest()
            ->first();

        $city = ($latestPanel && $latestPanel->zone && $latestPanel->zone->city)
            ? $latestPanel->zone->city
            : "Casablanca";

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

        $userPanelIds = Panel::where('user_id', $userId)->pluck('id');

        $totalEnergyToday = EnergyData::whereIn('panel_id', $userPanelIds)
            ->whereDate('created_at', today())
            ->sum('power');

        $activePanelsCount = Panel::where('user_id', $userId)
            ->where('status', 'active')
            ->count();

        $latestReadings = EnergyData::whereIn('panel_id', $userPanelIds)
            ->with('panel')
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact(
            'totalPanels',
            'totalPower',
            'activeZones',
            'maintenanceCount',
            'city',
            'weather',
            'totalEnergyToday',
            'activePanelsCount',
            'latestReadings'
        ));
    }

    public function Statistiques()
    {
        $latestData = EnergyData::orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $chartData = $latestData->reverse();

        return view('statistiques.statistique', compact(
            'latestData',
            'chartData'
        ));
    }
}
