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
        // كنجيبو غير المناطق ديال المستخدم الحالي مع الألواح اللي تابعين ليهم
        // هاد الطريقة أحسن حيت غاتعطيك كولشي ف دقة وحدة للـ Cards
        $zones = Auth::user()->zones()->with('panels')->get();
        
        // إلا بغيتي تعرضي الألواح بوحدهم ف جدول مثلاً
        $panels = Panel::where('user_id', Auth::id())->with('zone')->get();
        
        return view('panels.panel', compact('panels', 'zones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'serial_number' => 'required|string|unique:panels,serial_number',
            'power_capacity' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive,maintenance',
            'zone_id' => 'required|exists:zones,id',
        ]);

        Panel::create([
            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'power_capacity' => $request->power_capacity,
            'status' => $request->status,
            'user_id' => Auth::id(),
            'zone_id' => $request->zone_id,
        ]);

        return redirect()->route('panels.index')->with('success', 'Panneau créé avec succès !');
    }

    public function destroy(Panel $panel)
    {
        // تأكدي أن المستخدم كيمسح غير اللوح ديالو
        if ($panel->user_id !== Auth::id()) {
            return back()->with('error', 'Action non autorisée');
        }

        $panel->delete();
        return back()->with('success', 'Panneau supprimé !');
    }
}