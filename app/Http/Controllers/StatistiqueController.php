<?php

namespace App\Http\Controllers;

use App\Models\EnergyData;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    public function index()
{
    // كنجيبو آخر البيانات المسجلة مرتبة من الأحدث
    $latestData = EnergyData::orderBy('created_at', 'desc')->take(10)->get();
    
    // كنعكسو الترتيب للمبيان باش يجي من اليسار لليمين (الأقدم للأحدث)
    $chartData = $latestData->reverse();

    return view('statistiques.index', compact('latestData', 'chartData'));
}
}
