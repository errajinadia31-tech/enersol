@extends('layouts.layout')
@section('title','EnerSol | Dashboard')
@section('content')

<main class="text-white px-8 mt-10">

    <section>
        <div class="mx-auto grid grid-cols-1 lg:grid-cols-3 gap-[5rem] items-start">
            <div class="lg:col-span-1">
                <h1 class="text-6xl font-bold mb-6">
                    Welcome in,<br>
                    <span>Ener<span class="text-[#FBB108]">Sol</span></span>
                </h1>
                <p class="text-gray-400 text-lg font-light max-w-xs ">
                    Suivi et analyse de la production et de la consommation d'énergie solaire
                </p>

                <div class="flex mb-8 mt-2">
                    <div class="w-8 h-8 flex items-center justify-center rounded-full border text-green-600 border-green-600">
                        <i class="fa-solid fa-battery-full text-xs"></i>
                    </div>
                    <div class="w-8 h-8 flex items-center justify-center rounded-full border border-yellow-400 text-yellow-400">
                        <i class="fa-solid fa-bolt text-xs"></i>
                    </div>
                    <div class="w-8 h-8 flex items-center justify-center rounded-full border border-red-400 text-red-400">
                        <i class="fa-solid fa-triangle-exclamation text-xs"></i>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 flex justify-end">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div class="bg-[#121212]/50 backdrop-blur-md border border-white/10 p-8 rounded-[1rem] w-[320px] transition-all hover:border-[#FBB108]/30 group">
                        <div class="flex justify-between mb-6">
                            <h2 class="text-gray-400">Batterie 🔋</h2>
                        </div>
                        <div class="flex items-baseline gap-2">
                            <span class="text-white text-3xl font-black">{{ $totalPanels }}</span>
                            <span class="text-gray-500 text-[10px] uppercase font-bold">Unités</span>
                        </div>
                    </div>

                    <div class="bg-[#121212]/50 backdrop-blur-md border border-white/10 p-8 rounded-[1rem] w-[320px] transition-all hover:border-[#FBB108]/30 group">
                        <div class="flex justify-between items-center mb-8">
                            <h2 class="text-gray-400 text-xs uppercase tracking-[0.2em] font-bold">Météo</h2>
                            @if(isset($weather['weather'][0]['icon']))
                            <img src="http://openweathermap.org/img/wn/{{ $weather['weather'][0]['icon'] }}.png"
                                class="w-8 h-8 opacity-80 group-hover:scale-110 transition-transform" alt="weather icon">
                            @endif
                        </div>

                        @if($weather && isset($weather['main']))
                        <div class="space-y-1">
                            <h3 class="text-white text-3xl font-black italic tracking-tighter uppercase">
                                {{ $weather['name'] }}
                            </h3>
                            <div class="flex items-baseline gap-2">
                                <span class="text-[#FBB108] text-4xl font-black">
                                    {{ round($weather['main']['temp']) }}°
                                </span>
                                <span class="text-gray-500 text-[10px] uppercase font-bold tracking-widest">
                                    {{ $weather['weather'][0]['description'] }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-between border-t border-white/5 pt-4 text-[9px] text-gray-500 uppercase tracking-tighter font-bold">
                            <span>Humidité: {{ $weather['main']['humidity'] }}%</span>
                            <span>Vent: {{ round($weather['wind']['speed']) }} km/h</span>
                        </div>
                        @else
                        <div class="py-10 text-center">
                            <p class="text-gray-600 text-[10px] uppercase tracking-widest">Données indisponibles</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

   <section class="mt-8">
        {{-- استعملت gap-8 و max-w-full باش يجي العرض متناسق مع باقي الصفحة --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 w-full">
            
            <div class="bg-[#121212]/50 backdrop-blur-md border border-white/10 p-10 rounded-[1.5rem] flex flex-col hover:border-[#FBB108]/30 transition-all group h-full">
                <h2 class="text-gray-400 self-start mb-10 font-medium">Production d'énergie</h2>
                <div class="flex items-baseline gap-2">
                    <span id="live-power" class="text-[#FBB108] text-5xl font-black italic">0</span>
                    <span class="text-gray-500 text-[11px] uppercase font-bold tracking-widest">Watts</span>
                </div>
            </div>

            <div class="bg-[#121212]/50 backdrop-blur-md border border-white/10 p-10 rounded-[1.5rem] flex flex-col hover:border-blue-500/30 transition-all h-full">
                <h2 class="text-gray-400 self-start mb-10 font-medium">Consommation</h2>
                <div class="flex items-baseline gap-2">
                    <span id="live-cons" class="text-blue-400 text-5xl font-black italic">0</span>
                    <span class="text-gray-500 text-[11px] uppercase font-bold tracking-widest">kWh</span>
                </div>
            </div>

            <div class="bg-[#121212]/50 backdrop-blur-md border border-white/10 p-10 rounded-[1.5rem] flex flex-col hover:border-green-500/30 transition-all h-full">
                <h2 class="text-gray-400 self-start mb-10 font-medium">Capacité Totale</h2>
                <div class="flex items-baseline gap-2">
                    <span class="text-green-500 text-5xl font-black italic">{{ number_format($totalPower) }}</span>
                    <span class="text-gray-500 text-[11px] uppercase font-bold tracking-widest">Wp</span>
                </div>
            </div>

            <div class="bg-[#121212]/50 backdrop-blur-md border border-white/10 p-10 rounded-[1.5rem] flex flex-col hover:border-red-500/30 transition-all h-full">
                <h2 class="text-gray-400 self-start mb-10 font-medium italic">Maintenance</h2>
                <div class="flex items-baseline gap-2">
                    <span class="text-red-500 text-5xl font-black italic">{{ $maintenanceCount }}</span>
                    <span class="text-gray-500 text-[11px] uppercase font-bold tracking-widest">Alertes</span>
                </div>
            </div>

            <div class="bg-[#121212]/50 backdrop-blur-md border border-white/10 p-8 rounded-[1.5rem] flex flex-col w-full md:col-span-2 lg:col-span-4">
                <h2 class="text-gray-400 self-start mb-8 font-medium italic">Statistiques de Production</h2>
                <div class="h-[350px] w-full">
                    <canvas id="energyChart"></canvas>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('energyChart').getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(251, 177, 8, 0.4)');
    gradient.addColorStop(1, 'rgba(251, 177, 8, 0)');

    const totalCapacity = {{ $totalPower ?? 0 }};

    const energyChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [], 
            datasets: [{
                label: 'Puissance (W)',
                data: [], 
                borderColor: '#FBB108',
                backgroundColor: gradient,
                fill: true,
                tension: 0.4,
                borderWidth: 2,
                pointRadius: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { 
                    grid: { color: 'rgba(255, 255, 255, 0.05)' },
                    ticks: { color: '#6b7280' }
                },
                x: { 
                    grid: { display: false },
                    ticks: { color: '#6b7280' }
                }
            }
        }
    });

    function updateDashboard() {
        let currentPower = 0;
        if (totalCapacity > 0) {
            currentPower = Math.floor(totalCapacity * (0.8 + Math.random() * 0.15));
        }

        const time = new Date().toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });
        document.getElementById('live-power').innerText = currentPower;

        if (energyChart.data.labels.length > 10) {
            energyChart.data.labels.shift();
            energyChart.data.datasets[0].data.shift();
        }
        energyChart.data.labels.push(time);
        energyChart.data.datasets[0].data.push(currentPower);
        energyChart.update();
    }

    setInterval(updateDashboard, 5000);
    updateDashboard();
</script>

@endsection