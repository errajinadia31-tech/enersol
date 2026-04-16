@extends('layouts.layout')
@section('title','EnerSol | Gestion des Panneaux')

@section('content')
<div class="flex justify-between items-center mb-10 px-8">
    <h1 class="text-2xl font-bold text-white">Gestion des Panneaux</h1>
    <button onclick="toggleModal()" class="bg-[#FBB108] hover:bg-[#fbc547] text-black font-bold py-3 px-6 rounded-xl shadow-[0_0_20px_rgba(251,177,8,0.3)] transition-all active:scale-95 flex items-center gap-2">
        <i class="fa-solid fa-plus-circle"></i>
        Ajouter un Panneau
    </button>
</div>

@if(session('success'))
    <div class="max-w-4xl mx-auto mb-6 px-8">
        <div class="bg-green-500/10 border border-green-500/50 backdrop-blur-md text-green-500 p-4 rounded-xl flex items-center gap-3">
            <i class="fa-solid fa-check-circle text-lg"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    </div>
@endif


<div id="panelModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="fixed inset-0 bg-black/40 backdrop-blur-[4px]" onclick="toggleModal()"></div>

    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 w-full max-w-2xl p-8 rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.5)] transform transition-all">
            
            <button onclick="toggleModal()" class="absolute top-6 right-6 text-gray-400 hover:text-white transition">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>

            <div class="mb-8">
                <h2 class="text-2xl font-bold text-white flex items-center gap-3">
                    <span class="p-2 bg-[#FBB108]/10 rounded-lg">
                        <i class="fa-solid fa-solar-panel text-[#FBB108]"></i>
                    </span>
                    Configuration du Panneau
                </h2>
                <p class="text-gray-400 text-sm mt-2 font-light">Enregistrez les détails techniques de votre installation EnerSol.</p>
            </div>

            <form action="{{ route('panels.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-2">
                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider ml-1">Nom du Panneau</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 group-focus-within:text-[#FBB108] transition-colors">
                                <i class="fa-solid fa-tag text-xs"></i>
                            </span>
                            <input type="text" name="name" placeholder="Ex: Sud-Panel-01" required 
                                   class="w-full bg-white/5 border border-white/10 rounded-xl py-3 pl-10 pr-4 text-white placeholder-gray-600 focus:border-[#FBB108] focus:ring-1 focus:ring-[#FBB108] transition-all outline-none">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider ml-1">Numéro de Série</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 group-focus-within:text-[#FBB108] transition-colors">
                                <i class="fa-solid fa-barcode text-xs"></i>
                            </span>
                            <input type="text" name="serial_number" placeholder="SN-2026-XYZ" required 
                                   class="w-full bg-white/5 border border-white/10 rounded-xl py-3 pl-10 pr-4 text-white placeholder-gray-600 focus:border-[#FBB108] focus:ring-1 focus:ring-[#FBB108] transition-all outline-none">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider ml-1">Puissance (Watts)</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 group-focus-within:text-[#FBB108] transition-colors">
                                <i class="fa-solid fa-bolt text-xs"></i>
                            </span>
                            <input type="number" step="0.01" name="power_capacity" placeholder="450.00" required 
                                   class="w-full bg-white/5 border border-white/10 rounded-xl py-3 pl-10 pr-4 text-white placeholder-gray-600 focus:border-[#FBB108] focus:ring-1 focus:ring-[#FBB108] transition-all outline-none">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider ml-1">État de Fonctionnement</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fa-solid fa-circle-info text-xs"></i>
                            </span>
                            <select name="status" class="w-full bg-[#0d0d0d] border border-white/10 rounded-xl py-3 pl-10 pr-4 text-white appearance-none focus:border-[#FBB108] outline-none">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="maintenance">Maintenance</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-2">
                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider ml-1">Région</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fa-solid fa-map-location-dot text-xs"></i>
                            </span>
                            <select id="region-select" class="w-full bg-[#0d0d0d] border border-white/10 rounded-xl py-3 pl-10 pr-10 text-white appearance-none focus:border-[#FBB108] outline-none cursor-pointer">
                                <option value="" disabled selected>Choisir une région</option>
                                @foreach($zones->unique('name') as $zone)
                                    <option value="{{ $zone->name }}">{{ $zone->name }}</option>
                                @endforeach
                            </select>
                            <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-[10px] text-gray-500 pointer-events-none"></i>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider ml-1">Ville</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fa-solid fa-city text-xs"></i>
                            </span>
                            <select id="city-select" name="zone_id" required 
                                    class="w-full bg-[#0d0d0d] border border-white/10 rounded-xl py-3 pl-10 pr-10 text-white appearance-none focus:border-[#FBB108] outline-none cursor-pointer">
                                <option value="" disabled selected>Sélectionnez la ville</option>
                            </select>
                            <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-[10px] text-gray-500 pointer-events-none"></i>
                        </div>
                    </div>
                </div>

                <div class="pt-6 flex items-center justify-end gap-4 border-t border-white/5">
                    <button type="button" onclick="toggleModal()" class="text-gray-400 hover:text-white transition-colors text-sm font-medium px-4">
                        Annuler
                    </button>
                    <button type="submit" 
                            class="bg-[#FBB108] hover:bg-[#fbc547] text-black font-bold py-3 px-10 rounded-xl shadow-[0_4px_15px_rgba(251,177,8,0.4)] transition-all active:scale-95 flex items-center gap-2">
                        <i class="fa-solid fa-save"></i>
                        Enregistrer Configuration
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Section des Cards --}}
<div class="px-8 mt-10  rounded-3xl py-10 ">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($zones as $zone)
            @foreach($zone->panels as $panel)
                <div class="group relative bg-white/5 backdrop-blur-xl border border-white/10 p-6 rounded-[2rem] hover:border-[#FBB108]/50 transition-all duration-500 overflow-hidden">
                    
                    {{-- Decoration Effect --}}
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#FBB108]/10 rounded-full blur-3xl group-hover:bg-[#FBB108]/20 transition-all"></div>

                    {{-- Header della Card --}}
                    <div class="flex justify-between items-start mb-6 relative z-10 bg-[url('{{ asset('images/panel-background.jpg') }}')] bg-cover bg-center">
                        <div class="flex items-center gap-3">
                            <div class="p-3 bg-[#FBB108]/10 rounded-2xl group-hover:bg-[#FBB108] group-hover:text-black transition-all duration-300">
                                <i class="fa-solid fa-solar-panel text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-white font-bold text-lg leading-tight">{{ $panel->name }}</h3>
                                <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">{{ $panel->serial_number }}</p>
                            </div>
                        </div>
                        
                        {{-- Status Badge --}}
                        <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-tighter 
                            @if($panel->status == 'active') bg-green-500/10 text-green-500 border border-green-500/20
                            @elseif($panel->status == 'maintenance') bg-yellow-500/10 text-yellow-500 border border-yellow-500/20
                            @else bg-red-500/10 text-red-500 border border-red-500/20 @endif">
                            ● {{ $panel->status }}
                        </span>
                    </div>

                    {{-- Stats --}}
                    <div class="grid grid-cols-2 gap-4 mb-6 relative z-10">
                        <div class="bg-black/20 p-3 rounded-2xl border border-white/5">
                            <p class="text-[9px] text-gray-500 uppercase font-bold mb-1">Capacité</p>
                            <p class="text-white font-black">{{ $panel->power_capacity }} <span class="text-[10px] text-gray-500">W</span></p>
                        </div>
                        <div class="bg-black/20 p-3 rounded-2xl border border-white/5">
                            <p class="text-[9px] text-gray-500 uppercase font-bold mb-1">Localisation</p>
                            <p class="text-white font-black truncate">{{ $zone->city }}</p>
                        </div>
                    </div>

                    {{-- Footer/Actions --}}
                    <div class="flex items-center justify-between pt-4 border-t border-white/5 relative z-10">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-location-dot text-[#FBB108] text-[10px]"></i>
                            <span class="text-xs text-gray-400 font-medium">{{ $zone->name }}</span>
                        </div>
                        
                        <div class="flex gap-2">
                            <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white transition-all">
                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                            </button>
                            <form action="{{ route('panels.destroy', $panel->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce panneau ?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all">
        <i class="fa-solid fa-trash text-xs"></i>
    </button>
</form>
                        </div>
                    </div>
                </div>
            @endforeach
        @empty
            <div class="col-span-full py-20 text-center">
                <div class="inline-flex p-6 bg-white/5 rounded-full mb-4">
                    <i class="fa-solid fa-inbox text-4xl text-gray-600"></i>
                </div>
                <h3 class="text-white font-bold text-xl">Aucun panneau trouvé</h3>
                <p class="text-gray-500 mt-2">Commencez par ajouter votre premier équipement EnerSol.</p>
            </div>
        @endforelse
    </div>
</div>

{{-- JavaScript Logic --}}
<script>
    function toggleModal() {
        const modal = document.getElementById('panelModal');
        modal.classList.toggle('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const allZones = @json($zones);
        const regionSelect = document.getElementById('region-select');
        const citySelect = document.getElementById('city-select');

        regionSelect.addEventListener('change', function() {
            const selectedRegion = this.value;

            // Clear cities
            citySelect.innerHTML = '<option value="" disabled selected>Sélectionnez la ville</option>';

            // Filter zones
            const filteredCities = allZones.filter(zone => zone.name === selectedRegion);

            // Populate cities
            filteredCities.forEach(zone => {
                const option = document.createElement('option');
                option.value = zone.id;
                option.textContent = zone.city;
                option.className = "bg-[#0d0d0d] text-white";
                citySelect.appendChild(option);
            });
        });
    });
</script>
@endsection