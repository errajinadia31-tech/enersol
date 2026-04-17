<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Models\Panel;
use App\Models\EnergyData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller {
public function index()
{
    $user = Auth::user();
    $userId = $user->id; // تعريف المتغير باش ما يعطيكش Error

    // حساب الإحصائيات الخاصة بالمستخدم الحالي فقط
    $totalPanels = Panel::where('user_id', $userId)->count();
    $totalPower = Panel::where('user_id', $userId)->sum('power_capacity');
    $activeZones = Panel::where('user_id', $userId)->distinct('zone_id')->count('zone_id');
    $maintenanceCount = Panel::where('user_id', $userId)->where('status', 'maintenance')->count();

    // تحديد المدينة لجلب الطقس (بناءً على آخر بانيل تزاد)
    $latestPanel = Panel::where('user_id', $userId)
                        ->with('zone')
                        ->latest()
                        ->first();

    if ($latestPanel && $latestPanel->zone && $latestPanel->zone->city) {
        $city = $latestPanel->zone->city; 
    } else {
        // إذا ما عندوش ألواح، نشوفو واش عندو مناطق مسجلة، وإلا نخدمو بـ "Oujda" كـ Default
        $latestZone = $user->zones()->latest()->first();
        $city = ($latestZone && $latestZone->city) ? $latestZone->city : "Oujda";
    }

    // جلب بيانات الطقس
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
            // Fallback في حالة فشل الطلب بالمدينة المحددة
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

    // جلب بيانات الطاقة والرسوم المبيانية
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
        'totalEnergyToday', 
        'activePanelsCount', 
        'latestReadings', 
        'weather',
        'totalPanels', 
        'totalPower', 
        'activeZones', 
        'maintenanceCount'
    ));
}

public function Statistiques()
{
    $latestData = collect();
    for ($i = 10; $i >= 0; $i--) {
        $voltage = rand(218, 225); 
        $current = rand(1, 5) + (rand(0, 9) / 10); 
        
        $latestData->push((object)[
            'created_at' => now()->subMinutes($i),
            'voltage' => $voltage,
            'current' => $current,
            'power' => round($voltage * $current, 2)
        ]);
    }
        // جلب البيانات من الموديل ديالك
    $latestData = EnergyData::orderBy('created_at', 'desc')->take(10)->get();
    
    // عكس الترتيب للمبيان
    $chartData = $latestData->reverse();

    // تأكدي أن اسم الـ view هو نفسو اللي عندك في الفولدر
    return view('statistiques.statistique', compact('latestData', 'chartData'));

    return view('statistiques.statistique', [
        'latestData' => $latestData->reverse() 
    ]);
}

}