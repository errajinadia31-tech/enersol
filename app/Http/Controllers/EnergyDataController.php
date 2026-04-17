<?php

namespace App\Http\Controllers;

use App\Models\EnergyData;
use Illuminate\Http\Request;

class EnergyDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EnergyData $energyData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EnergyData $energyData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EnergyData $energyData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EnergyData $energyData)
    {
        //
    }

public function getChartData($panel_id) {
    // التأكد أن المستخدم يملك هذه اللوحة
    $panel = auth()->user()->panels()->findOrFail($panel_id);

    $data = $panel->energyData() // استخدام العلاقة مباشرة أسرع وأكثر أماناً
                ->latest()
                ->take(20)
                ->get(['voltage', 'current', 'power', 'created_at']);
                
    return response()->json($data);
}

}
