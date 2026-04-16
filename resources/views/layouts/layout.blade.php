<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- tailwind css  -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- logo icon -->
    <link rel="shortcut icon" href="{{asset('images/logo.png')}}" type="image/x-icon">
    <!-- font google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>@yield('title', config('app.name', 'EnerSol'))</title>
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .nav-link { transition: all 0.3s ease; border: 1px solid rgba(255,255,255,0.1); }
        .nav-link:hover { background: rgba(255,255,255,0.1); border-color: #FBB108; }
        .active-nav { background: white !important; color: black !important; font-weight: 700; border-color: white; }
    </style>
</head>

<body class="bg-cover bg-center h-screen bg-[url('{{ asset("images/dashboard_bg.jpeg") }}')] ">

    <div class="h-full bg-black/70 backdrop-blur-[8px] p-6 flex flex-col">
        <!-- navbar start-->
        <header class="flex items-center justify-between px-8 py-4 text-white mb-6">
            <div class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" class="w-[38px]" alt="Logo">
                <span class="font-bold text-2xl tracking-tighter uppercase italic">Ener<span class="text-[#FBB108]">Sol</span></span>
            </div>
            
            <nav class="hidden lg:flex gap-3 text-xs uppercase tracking-widest">
                <a href="{{ route('dashboard') }}" class="nav-link rounded-full px-5 py-2.5 {{ request()->routeIs('dashboard') ? 'active-nav' : '' }}">Dashboard</a>
                <a href="#" class="nav-link rounded-full px-5 py-2.5">Consommation</a>
                <a href="{{ route('statistiques') }}" class="nav-link rounded-full px-5 py-2.5 {{ request()->routeIs('statistiques') ? 'active-nav' : '' }}">Statistique</a>
                <a href="{{ route('panels.index') }}" class="nav-link rounded-full px-5 py-2.5 {{ request()->routeIs('panels.index') ? 'active-nav' : '' }}">Panneaux</a>
                <a href="#" class="nav-link rounded-full px-5 py-2.5">Rapports</a>
            </nav>

            <div class="flex items-center gap-3">
                <div class="flex items-center border-r border-white/10 pr-4 gap-2">
                    <button class="w-8 h-8 flex items-center justify-center rounded-full bg-white/5 hover:bg-[#FBB108] hover:text-black transition">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-full bg-white/5 hover:bg-[#FBB108] hover:text-black transition relative">
                        <i class="fa-regular fa-bell text-xs"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full border border-black"></span>
                    </button>
                </div>
                
               <div class="relative">
    <button onclick="toggleProfileMenu(event)" class="flex items-center gap-3 pl-2 py-1 rounded-full hover:bg-white/5 transition focus:outline-none">
        <div class="w-9 h-9 flex items-center justify-center rounded-full bg-gradient-to-tr from-[#FBB108] to-yellow-200 text-black font-bold">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
        <i class="fa-solid fa-chevron-down text-[10px] text-gray-400"></i>
    </button>

    <div id="profileMenu" class="absolute right-0 mt-3 w-48 bg-[#121212] backdrop-blur-xl rounded-2xl border border-white/10 hidden shadow-2xl z-50 overflow-hidden">
        <div class="px-4 py-3 border-b border-white/5 bg-white/5">
            <p class="text-[10px] text-gray-400 uppercase tracking-tighter">Connecté en tant que</p>
            <p class="text-sm font-bold truncate">{{ Auth::user()->name }}</p>
        </div>
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-xs hover:bg-white/5 transition text-white">
            <i class="fa-regular fa-user text-[#FBB108]"></i> Mon Profil
        </a>
<form method="POST" action="{{ route('logout') }}" id="logout-form">
    @csrf
    <button type="button" 
            onclick="confirmLogout()"
            class="w-full group flex items-center gap-3 px-6 py-4 text-[11px] font-bold uppercase tracking-widest text-red-400/80 hover:text-red-400 hover:bg-red-500/5 transition-all duration-300 rounded-xl border border-transparent hover:border-red-500/10">
        <i class="fa-solid fa-power-off group-hover:scale-110 transition-transform"></i>
        <span>Déconnexion</span>
    </button>
</form>
    </div>
</div>
            </div>
        </header>
        <!-- navbar end -->
        
        <main class="flex-1 overflow-y-auto custom-scrollbar">
            @yield('content')
        </main>
    
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #FBB108; }
    </style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function toggleProfileMenu(event) {
        event.stopPropagation();
        const menu = document.getElementById('profileMenu');
        menu.classList.toggle('hidden');
    }

    window.addEventListener('click', function(e) {
        const menu = document.getElementById('profileMenu');
        if (!menu.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
function confirmLogout() {
    Swal.fire({
        title: '<span class="text-white uppercase tracking-widest text-lg font-black italic">Déconnexion</span>',
        html: '<p class="text-gray-400 text-xs">Voulez-vous vraiment quitter l\'interface EnerSol ?</p>',
        background: '#121212', 
        showCancelButton: true,
        confirmButtonColor: '#FBB108', 
        cancelButtonColor: 'rgba(255,255,255,0.05)', 
        confirmButtonText: '<span class="text-black font-bold text-xs uppercase">Oui, Quitter</span>',
        cancelButtonText: '<span class="text-gray-400 font-bold text-xs uppercase">Annuler</span>',
        backdrop: `rgba(0,0,0,0.8)`, 
        
        // --- التعديلات الجديدة ---
        heightAuto: false, 
        scrollbarPadding: false,
        // -----------------------

        customClass: {
            popup: 'border border-white/10 rounded-[1.5rem] shadow-2xl', 
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
    })
}

</script>
</body>
</html>