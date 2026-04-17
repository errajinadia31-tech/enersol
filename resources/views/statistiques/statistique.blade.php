@extends('layouts.layout')
@section('title','EnerSol | Statistiques')
@section('content')

<div class="p-8 space-y-8 min-h-screen text-white">
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 w-full">
        
        <div class="bg-[#121212]/50 backdrop-blur-md border border-white/10 p-10 rounded-[1.5rem] flex flex-col hover:border-[#FBB108]/30 transition-all shadow-2xl">
            <h2 class="text-gray-400 self-start mb-10 font-medium tracking-wide">Production d'énergie</h2>
            <div class="flex items-baseline gap-2 mt-4">
                {{-- On affiche 0 par défaut comme demandé --}}
                <span id="stat-power" class="text-[#FBB108] text-5xl font-black italic tracking-tighter">
                    {{ $latestData->isNotEmpty() ? $latestData->first()->power : '0' }}
                </span>
                <span class="text-gray-500 text-[11px] uppercase font-bold tracking-widest">Watts</span>
            </div>
        </div>

        <div class="bg-[#121212]/50 backdrop-blur-md border border-white/10 p-10 rounded-[1.5rem] flex flex-col hover:border-blue-400/30 transition-all shadow-2xl">
            <h2 class="text-gray-400 self-start mb-10 font-medium tracking-wide">Consommation</h2>
            <div class="flex items-baseline gap-2 mt-4">
                <span class="text-blue-400 text-5xl font-black italic tracking-tighter">0</span>
                <span class="text-gray-500 text-[11px] uppercase font-bold tracking-widest">kWh</span>
            </div>
        </div>

        <div class="bg-[#121212]/50 backdrop-blur-md border border-white/10 p-10 rounded-[1.5rem] flex flex-col hover:border-white/20 transition-all shadow-2xl">
            <h2 class="text-gray-400 self-start mb-6 font-medium tracking-wide uppercase text-[10px]">Tendance de Production</h2>
            <div class="w-full h-full min-h-[100px]">
                <canvas id="minichart"></canvas>
            </div>
        </div>
    </div>

    <div class="bg-[#121212]/50 backdrop-blur-md border border-white/10 rounded-[1.5rem] overflow-hidden shadow-2xl">
        <div class="px-8 py-6 border-b border-white/5 bg-white/5 flex justify-between items-center">
            <h3 class="text-sm font-bold uppercase tracking-[0.2em] text-gray-400">Historique des mesures</h3>
            <span class="text-[10px] text-[#FBB108] bg-[#FBB108]/10 px-3 py-1 rounded-full border border-[#FBB108]/20 italic">Live Data</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-white/5 text-gray-500 uppercase text-[10px] tracking-widest">
                    <tr>
                        <th class="px-8 py-5">Heure</th>
                        <th class="px-8 py-5">Voltage (V)</th>
                        <th class="px-8 py-5">Courant (A)</th>
                        <th class="px-8 py-5">Puissance (W)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 text-gray-300">
                    @forelse($latestData as $data)
                    <tr class="hover:bg-white/5 transition-colors group">
                        <td class="px-8 py-5 font-mono text-gray-400">{{ $data->created_at->format('H:i:s') }}</td>
                        <td class="px-8 py-5 text-gray-400">{{ $data->voltage }}V</td>
                        <td class="px-8 py-5 text-gray-400">{{ $data->current }}A</td>
                        <td class="px-8 py-5 font-bold text-[#FBB108] text-lg">{{ $data->power }}W</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center text-gray-500 italic">
                            <i class="fa-solid fa-plug-circle-exclamation mb-2 block text-2xl text-gray-600"></i>
                            Aucune donnée disponible. En attente de connexion...
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@php
    $chartData = $latestData->reverse();
    $labels = $chartData->pluck('created_at')->map(fn($d) => \Carbon\Carbon::parse($d)->format('H:i'));
    $powers = $chartData->pluck('power');
@endphp

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('minichart').getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 100);
    gradient.addColorStop(0, 'rgba(251, 177, 8, 0.4)');
    gradient.addColorStop(1, 'rgba(251, 177, 8, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                data: @json($powers),
                borderColor: '#FBB108',
                borderWidth: 2,
                fill: true,
                backgroundColor: gradient,
                tension: 0.4,
                pointRadius: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { x: { display: false }, y: { display: false } }
        }
    });
});
</script>
@endsection