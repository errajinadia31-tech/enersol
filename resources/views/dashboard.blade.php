@extends('layouts.layout')
@section('title','EnerSol | Dashboard')
@section('content')

<main class="text-white px-8 mt-10 min-h-screen">

    <section>
        <div class="mx-auto grid grid-cols-1 lg:grid-cols-3 gap-[5rem] items-start">
            <div class="lg:col-span-1">
                <h1 class="text-6xl font-bold mb-2 leading-tight">
                    Welcome in,<br>
                    <span class="italic">Ener<span class="text-[#FBB108]">Sol</span></span>
                </h1>
                <p class="text-gray-400 text-lg font-light max-w-xs leading-relaxed">
                    Suivi et analyse de la production et de la consommation d'énergie solaire en temps réel.
                </p>

                <div class="flex mb-8 mt-6">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full border text-green-500 border-green-500/30 bg-green-500/5 hover:bg-green-500/20 transition-colors">
                        <i class="fa-solid fa-battery-full text-sm"></i>
                    </div>
                    <div class="w-10 h-10 flex items-center justify-center rounded-full border border-yellow-400/30 text-yellow-400 bg-yellow-400/5 hover:bg-yellow-400/20 transition-colors">
                        <i class="fa-solid fa-bolt text-sm"></i>
                    </div>
                    <div class="w-10 h-10 flex items-center justify-center rounded-full border border-red-400/30 text-red-400 bg-red-400/5 hover:bg-red-400/20 transition-colors">
                        <i class="fa-solid fa-triangle-exclamation text-sm"></i>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 flex justify-end">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-[#121212]/50 backdrop-blur-md border border-white/10 p-8 rounded-[1.5rem] w-[320px] transition-all hover:border-[#FBB108]/30 group shadow-xl">
                        <div class="flex justify-between mb-6">
                            <h2 class="text-gray-400 uppercase text-[10px] tracking-widest font-bold">Système 🔋</h2>
                            <span class="text-[10px] text-green-500 bg-green-500/10 px-2 py-0.5 rounded italic">En Ligne</span>
                        </div>
                        <div class="flex items-baseline gap-2">
                            <span class="text-white text-4xl font-black italic tracking-tighter">{{ $totalPanels }}</span>
                            <span class="text-gray-500 text-[10px] uppercase font-bold tracking-widest">Panneaux</span>
                        </div>
                    </div>

                    <div class="bg-[#121212]/50 backdrop-blur-md border border-white/10 p-8 rounded-[1.5rem] w-[320px] transition-all hover:border-blue-400/30 group shadow-xl">
                        <div class="flex justify-between items-center mb-8">
                            <h2 class="text-gray-400 text-[10px] uppercase tracking-widest font-bold">Météo Locale</h2>
                            @if(isset($weather['weather'][0]['icon']))
                            <img src="http://openweathermap.org/img/wn/{{ $weather['weather'][0]['icon'] }}.png"
                                class="w-10 h-10 opacity-80 group-hover:scale-110 transition-transform filter drop-shadow-[0_0_8px_rgba(251,177,8,0.5)]" alt="weather icon">
                            @endif
                        </div>

                        @if($weather && isset($weather['main']))
                        <div class="space-y-1">
                            <h3 class="text-white text-2xl font-black italic tracking-tighter uppercase truncate">
                                {{ $weather['name'] }}
                            </h3>
                            <div class="flex items-baseline gap-2">
                                <span class="text-[#FBB108] text-4xl font-black italic">
                                    {{ round($weather['main']['temp']) }}°
                                </span>
                                <span class="text-gray-500 text-[9px] uppercase font-bold tracking-[0.1em]">
                                    {{ $weather['weather'][0]['description'] }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-8 flex justify-between border-t border-white/5 pt-4 text-[9px] text-gray-500 uppercase font-bold">
                            <span>Humidité: <span class="text-white">{{ $weather['main']['humidity'] }}%</span></span>
                            <span>Vent: <span class="text-white">{{ round($weather['wind']['speed']) }} km/h</span></span>
                        </div>
                        @else
                        <div class="py-6 text-center italic text-gray-600 text-xs">Données météo indisponibles</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- card section  -->
   <section class="mt-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 w-full">
            
            <div class="bg-[#121212]/50 backdrop-blur-md border border-white/10 p-10 rounded-[1.5rem] flex flex-col hover:border-[#FBB108]/30 transition-all group shadow-2xl relative overflow-hidden">
                <div class="absolute -right-2 -top-2 opacity-5 group-hover:opacity-10 transition-opacity">
                    <i class="fa-solid fa-sun text-8xl text-[#FBB108]"></i>
                </div>
                <h2 class="text-gray-400 self-start mb-10 font-medium uppercase text-[10px] tracking-widest">Production Actuelle</h2>
                <div class="flex items-baseline gap-2">
                    <span id="live-power" class="text-[#FBB108] text-6xl font-black italic tracking-tighter">0</span>
                    <span class="text-gray-500 text-[11px] uppercase font-bold tracking-widest">Watts</span>
                </div>
            </div>

            <div class="bg-[#121212]/50 backdrop-blur-md border border-white/10 p-10 rounded-[1.5rem] flex flex-col hover:border-blue-500/30 transition-all group shadow-2xl relative overflow-hidden">
                <div class="absolute -right-2 -top-2 opacity-5 group-hover:opacity-10 transition-opacity">
                    <i class="fa-solid fa-bolt text-8xl text-blue-500"></i>
                </div>
                <h2 class="text-gray-400 self-start mb-10 font-medium uppercase text-[10px] tracking-widest">Consommation Estimée</h2>
                <div class="flex items-baseline gap-2">
                    <span id="live-cons" class="text-blue-400 text-6xl font-black italic tracking-tighter">0</span>
                    <span class="text-gray-500 text-[11px] uppercase font-bold tracking-widest">Watts</span>
                </div>
            </div>

            <div class="bg-[#121212]/50 backdrop-blur-md border border-white/10 p-10 rounded-[1.5rem] flex flex-col hover:border-green-500/30 transition-all shadow-2xl">
                <h2 class="text-gray-400 self-start mb-10 font-medium uppercase text-[10px] tracking-widest">Capacité Système</h2>
                <div class="flex items-baseline gap-2">
                    <span class="text-green-500 text-6xl font-black italic tracking-tighter">{{ number_format($totalPower) }}</span>
                    <span class="text-gray-500 text-[11px] uppercase font-bold tracking-widest">Wp</span>
                </div>
            </div>

            <div class="bg-[#121212]/50 backdrop-blur-md border border-white/10 p-10 rounded-[1.5rem] flex flex-col hover:border-red-500/30 transition-all shadow-2xl">
                <h2 class="text-gray-400 self-start mb-10 font-medium uppercase text-[10px] tracking-widest">Maintenance</h2>
                <div class="flex items-baseline gap-2">
                    <span class="text-red-500 text-6xl font-black italic tracking-tighter">{{ $maintenanceCount }}</span>
                    <span class="text-gray-500 text-[11px] uppercase font-bold tracking-widest">Alertes</span>
                </div>
            </div>

            <div class="bg-[#121212]/50 backdrop-blur-md border border-white/10 p-8 rounded-[2rem] flex flex-col w-full md:col-span-2 lg:col-span-4 shadow-3xl">
                <div class="flex justify-between items-center mb-10 px-4">
                    <h2 class="text-gray-300 font-bold italic uppercase tracking-widest text-sm border-l-2 border-[#FBB108] pl-4">Graphique de Production Live</h2>
                    <span class="flex items-center gap-2 text-[10px] text-[#FBB108] bg-[#FBB108]/10 px-4 py-1 rounded-full border border-[#FBB108]/20 animate-pulse font-bold">● LIVE UPDATING</span>
                </div>
                <div class="h-[400px] w-full">
                    
                    <canvas id="energyChart"></canvas>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('energyChart').getContext('2d');
    
    // تدرج لوني للإنتاج (الأصفر)
    const prodGradient = ctx.createLinearGradient(0, 0, 0, 400);
    prodGradient.addColorStop(0, 'rgba(251, 177, 8, 0.3)');
    prodGradient.addColorStop(1, 'rgba(251, 177, 8, 0)');

    const totalCapacity = {{ $totalPower ?? 0 }};

    const energyChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [], 
            datasets: [
                {
                    label: 'Production (W)',
                    data: [], 
                    borderColor: '#FBB108',
                    backgroundColor: prodGradient,
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 0
                },
                {
                    label: 'Consommation (W)',
                    data: [], 
                    borderColor: '#3b82f6', // لون أزرق للاستهلاك
                    backgroundColor: 'transparent',
                    fill: false,
                    tension: 0.4,
                    borderWidth: 2,
                    borderDash: [5, 5], // خط متقطع باش نفرقوهم
                    pointRadius: 0
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { 
                    display: true, 
                    labels: { color: '#9ca3af', font: { size: 10, weight: 'bold' } } 
                } 
            },
            scales: {
                y: { grid: { color: 'rgba(255, 255, 255, 0.05)' }, ticks: { color: '#6b7280' } },
                x: { grid: { display: false }, ticks: { color: '#6b7280' } }
            }
        }
    });

    function updateDashboard() {
        let currentPower = 0;
        let currentCons = 0;

        if (totalCapacity > 0) {
            // محاكاة الإنتاج
            currentPower = Math.floor(totalCapacity * (0.7 + Math.random() * 0.2));
            // محاكاة الاستهلاك (ديما كيكون متغير)
            currentCons = Math.floor(currentPower * (0.5 + Math.random() * 0.3));
        }

        const time = new Date().toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });
        
        document.getElementById('live-power').innerText = currentPower;
        document.getElementById('live-cons').innerText = currentCons;

        if (energyChart.data.labels.length > 12) {
            energyChart.data.labels.shift();
            energyChart.data.datasets[0].data.shift(); // Production
            energyChart.data.datasets[1].data.shift(); // Consommation
        }

        energyChart.data.labels.push(time);
        energyChart.data.datasets[0].data.push(currentPower);
        energyChart.data.datasets[1].data.push(currentCons);
        energyChart.update();
    }

    setInterval(updateDashboard, 5000);
    updateDashboard();
</script>

<style>
    /* تحسين شكل الـ Scrollbar */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: #0a0a0a; }
    ::-webkit-scrollbar-thumb { background: #1f1f1f; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: #FBB108; }
</style>

@endsection