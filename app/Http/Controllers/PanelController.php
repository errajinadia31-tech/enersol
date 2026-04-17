<?php

namespace App\Http\Controllers;

use App\Models\Panel;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    public function index()
    {
        $panels = Panel::where('user_id', auth()->id())->get();
        // 1. Njibo ga3 l-Zones (Global): Bach ay user y-selecti l-ville dyalo
        $zones = Zone::all(); 

        // 2. Njibo l-Panels (Privé): Ghir li fihom user_id dyal l-user li t-connecta daba
        // Haka user "A" madiychoufch panels dyal user "B"
        $panels = Panel::where('user_id', Auth::id())
                      ->with('zone') // Kan-jibo smit l-zone bach n-affichiwha f l-jadwal
                      ->latest()     // Bach ytla3 l-jdid howa l-fowqani
                      ->get();
        
        return view('panels.panel', compact('panels', 'zones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'serial_number'  => 'required|string|unique:panels,serial_number',
            'power_capacity' => 'required|numeric|min:0',
            'status'         => 'required|in:active,inactive,maintenance',
            'zone_id'        => 'required|exists:zones,id',
        ]);

        // Hna dima kanswiviw chkon kraya l-panel
        Panel::create([
            'name'           => $request->name,
            'serial_number'  => $request->serial_number,
            'power_capacity' => $request->power_capacity,
            'status'         => $request->status,
            'user_id'        => Auth::id(), 
            'zone_id'        => $request->zone_id,
        ]);

        return redirect()->route('panels.index')->with('success', 'Votre panneau a été ajouté.');
    }

    public function destroy(Panel $panel)
    {
        // Securité: Ila chi user 7awel y-msah panel dyal wahed akhor b l-ID
        if ($panel->user_id !== Auth::id()) {
            return abort(403, 'Hadi machi dyalk!');
        }

        $panel->delete();
        return back()->with('success', 'Supprimé avec succès.');
    }
}