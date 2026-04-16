@extends('layouts.layout')
@section('title','EnerSol | Statistiques')
@section('content')


  
    <div class="p-6 space-y-6  min-h-screen text-white">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
            
            <div class="bg-[#121212]/50 backdrop-blur-md border border-white/10 p-8 rounded-[1rem] flex flex-col min-h-[160px]">
                <h2 class="text-gray-400 self-start mb-auto font-medium tracking-wide">Production d'énergie</h2>
                <div class="flex items-baseline gap-2 mt-4">
                    <span class="text-[#FBB108] text-4xl font-black italic tracking-tighter">
                        {{ $latestData->first()->power }}
                    </span>
                    <span class="text-gray-500 text-[10px] uppercase font-bold tracking-widest">Watts</span>
                </div>
            </div>

            <div class="bg-[#121212]/50 backdrop-blur-md border border-white/10 p-8 rounded-[1rem] flex flex-col min-h-[160px]">
                <h2 class="text-gray-400 self-start mb-auto font-medium tracking-wide">Consommation</h2>
                <div class="flex items-baseline gap-2 mt-4">
                    <span class="text-blue-400 text-4xl font-black italic tracking-tighter">14.2</span>
                    <span class="text-gray-500 text-[10px] uppercase font-bold tracking-widest">kWh</span>
                </div>
            </div>

            <div class="bg-[#121212]/50 backdrop-blur-md border border-white/10 p-8 rounded-[1rem] flex flex-col min-h-[160px]">
                <h2 class="text-gray-400 self-start mb-4 font-medium tracking-wide">Statistique</h2>
                <div class="w-full h-full">
                    <canvas id="miniChart"></canvas>
                </div>
            </div>
        </div>

        <div class="bg-[#121212]/50 border border-white/10 rounded-[1rem] overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead class="bg-white/5 text-gray-500 uppercase text-[10px] tracking-widest">
                    <tr>
                        <th class="px-6 py-4">Heure</th>
                        <th class="px-6 py-4">Voltage (V)</th>
                        <th class="px-6 py-4">Courant (A)</th>
                        <th class="px-6 py-4">Puissance (W)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 text-gray-300">
                    @foreach($latestData as $data)
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 font-mono">{{ $data->created_at->format('H:i:s') }}</td>
                        <td class="px-6 py-4">{{ $data->voltage }}V</td>
                        <td class="px-6 py-4">{{ $data->current }}A</td>
                        <td class="px-6 py-4 font-bold text-[#FBB108]">{{ $data->power }}W</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('miniChart').getContext('2d');
        const miniChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($latestData->pluck('created_at')->map(fn($d) => $d->format('H:i'))) !!},
                datasets: [{
                    data: {!! json_encode($latestData->pluck('power')) !!},
                    borderColor: '#FBB108',
                    borderWidth: 2,
                    fill: false,
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
    </script>

@endsection
