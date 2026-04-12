<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <title>ENERSOL - Intelligent Solar Management</title>
    <style>
        .text-ener-gold {
            color: #FBB108;
        }

        .bg-ener-gold {
            background-color: #FBB108;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #FBB108 !important;
        }

        .glass-nav {
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body class="bg-[#0a0a0a] text-white antialiased">
    <!-- navbar start -->
    <header>
        <nav class="absolute top-0 left-0 w-full z-20 flex items-center justify-between px-12 py-6 text-white bg-black/20 backdrop-blur-sm">
            <div class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" class="w-[38px]" alt="Logo">
                <span class="font-bold text-2xl tracking-tighter uppercase italic">Ener<span class="text-[#FBB108]">Sol</span></span>
            </div>

            <nav class="hidden md:flex items-center gap-4 text-xs font-bold uppercase tracking-widest">
                <a href=""
                    class="border rounded-full px-5 py-2 transition-all  hover:bg-white hover:text-black transition duration-300">
                    Home
                </a>

                <a href="#features"
                    class="border border-white/20 rounded-full px-5 py-2 text-gray-300 transition-all hover:bg-white hover:text-black transition duration-300 ">
                    Features
                </a>

                <a href="#about"
                    class="border border-white/20 rounded-full px-5 py-2  text-gray-300 transition-all hover:bg-white hover:text-black transition duration-300 ">
                    About Us
                </a>
            </nav>
            <div class="hidden md:block">
                <a href="{{ route('login') }}" class="px-5 py-2 border border-white/50 rounded-full hover:bg-white hover:text-black transition duration-300 text-sm">Se connecter</a>
                <a href="{{ route('register') }}" class="px-5 py-2 border border-white/50 rounded-full hover:bg-white hover:text-black transition duration-300 text-sm">S'inscrire</a>
            </div>

        </nav>
    </header>
    <!-- navbar end -->

    <!-- hero section start -->
    <section class="relative h-screen w-full overflow-hidden bg-[#050505]">

        <div class="absolute inset-0 z-0">
            <video class="w-full h-full object-cover " autoplay muted loop playsinline>
                <source src="{{ asset('videos/video_bg.mp4') }}" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-gradient-to-r from-black via-black/40 to-transparent"></div>
            <div class="absolute inset-0 bg-black/20 backdrop-blur-[2px]"></div>
        </div>

        <div class="relative z-10 h-full container mx-auto px-6 flex flex-col justify-center">
            <div class="max-w-4xl">

                <div class="flex items-center gap-4 mb-6" data-aos="fade-down">
                    <div class="h-[1px] w-12 bg-[#FBB108]"></div>
                    <span class="text-[#FBB108] text-[10px] font-black uppercase tracking-[0.5em]">Next-Gen Solar Intelligence</span>
                </div>

                <h1 class="text-7xl md:text-[120px] font-black leading-none uppercase italic tracking-tighter text-white" data-aos="fade-right" data-aos-delay="200">
                    SOLAR <br>
                    <span class="text-transparent" style="-webkit-text-stroke: 1.5px #FBB108;">ENERGY</span>
                </h1>

                <div class="grid md:grid-cols-2 gap-6 mt-12" data-aos="fade-up" data-aos-delay="400">

                    <div class="p-8 bg-black/40 backdrop-blur-xl border border-white/10 rounded-[2rem] flex flex-col justify-between">
                        <p class="text-white/60 text-lg leading-relaxed">
                            Prenez le contrôle total de votre production d'énergie avec une interface intuitive et des données en temps réel.
                        </p>
                        <div class="mt-8 flex gap-4">
                            <a href="{{ route('register') }}" class="px-8 py-4 bg-[#FBB108] text-black font-black uppercase text-[10px] tracking-widest rounded-full hover:bg-white transition-all">
                                Commencer
                            </a>
                            <button class="w-12 h-12 flex items-center justify-center border border-white/20 rounded-full text-white hover:bg-white/10">
                                <i class="fa-solid fa-play text-[10px]"></i>
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-6 bg-white/5 backdrop-blur-md border border-white/10 rounded-[2rem] flex flex-col items-center justify-center text-center group hover:border-[#FBB108]/50 transition-all">
                            <i class="fa-solid fa-chart-line text-[#FBB108] mb-3 text-xl"></i>
                            <span class="text-[9px] text-white/40 uppercase font-bold tracking-widest">Analytics</span>
                        </div>
                        <div class="p-6 bg-white/5 backdrop-blur-md border border-white/10 rounded-[2rem] flex flex-col items-center justify-center text-center group hover:border-[#FBB108]/50 transition-all">
                            <i class="fa-solid fa-leaf text-[#FBB108] mb-3 text-xl"></i>
                            <span class="text-[9px] text-white/40 uppercase font-bold tracking-widest">Eco-Friendly</span>
                        </div>
                        <div class="col-span-2 p-6 bg-[#FBB108]/10 backdrop-blur-md border border-[#FBB108]/20 rounded-[2rem] flex items-center justify-between px-8">
                            <div>
                                <p class="text-[10px] text-[#FBB108] font-black uppercase">Live Status</p>
                                <p class="text-white font-bold">System Online</p>
                            </div>
                            <div class="w-2 h-2 rounded-full bg-[#FBB108] animate-ping"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="absolute right-10 top-1/2 -translate-y-1/2 hidden lg:flex flex-col gap-8 items-center">
            <div class="h-32 w-[1px] bg-gradient-to-b from-transparent via-white/20 to-transparent"></div>
            <a href="#" class="rotate-90 text-[10px] uppercase tracking-[0.4em] text-white/30 hover:text-[#FBB108] transition-all">Instagram</a>
            <a href="#" class="rotate-90 text-[10px] uppercase tracking-[0.4em] text-white/30 hover:text-[#FBB108] transition-all">LinkedIn</a>
            <div class="h-32 w-[1px] bg-gradient-to-b from-transparent via-white/20 to-transparent"></div>
        </div>

    </section>
    <!-- hero section end -->


    <!-- features section start -->
    <section class="py-32 px-8 xl:px-0 bg-[#0a0a0a]" id="features">
        <div class="text-center mb-20">
            <h3 class="text-ener-gold uppercase tracking-[0.4em] text-xs font-bold mb-3" data-aos="fade-up">Technologie</h3>
            <h2 class="text-4xl md:text-5xl font-black uppercase" data-aos="fade-up" data-aos-delay="200">Our <span class="italic font-light">Features</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-6xl mx-auto">

            <div class="bg-[#121212] p-12 relative overflow-hidden group border border-white/5 hover:border-ener-gold/50 transition-all duration-500 rounded-2xl" data-aos="fade-right">
                <div class="relative z-10 lg:pr-40">
                    <h2 class="text-white mb-4 text-2xl xl:text-3xl font-bold uppercase italic">Suivi en Temps Réel</h2>
                    <p class="text-gray-500 leading-relaxed">Visualisez la production et la consommation d’énergie solaire instantanément grâce à notre plateforme intelligente connectée.</p>
                </div>
                <div class="absolute right-0 bottom-0 transform transition-transform group-hover:scale-110 duration-500">
                    <img src="{{ asset('images/img1.jpg') }}" class="w-[14rem] rounded-tl-[100%] opacity-40 group-hover:opacity-80" alt="Monitoring">
                </div>
            </div>

            <div class="bg-[#181818] p-12 relative overflow-hidden group border border-white/5 hover:border-ener-gold/50 transition-all duration-500 rounded-2xl" data-aos="fade-up-left">
                <div class="relative z-10 lg:pl-40">
                    <h2 class="text-white mb-4 text-2xl xl:text-3xl font-bold uppercase italic text-right">Analyse & Rapports</h2>
                    <p class="text-gray-500 leading-relaxed text-right">Obtenez des rapports détaillés de 7, 15 ou 30 jours pour optimiser votre efficacité énergétique au quotidien.</p>
                </div>
                <div class="absolute left-0 bottom-0 transform transition-transform group-hover:scale-110 duration-500">
                    <img src="{{ asset('images/img2.jpg') }}" class="w-[14rem] rounded-tr-[100%] opacity-40 group-hover:opacity-80" alt="Analysis">
                </div>
            </div>

            <div class="bg-[#181818] p-12 relative overflow-hidden group border border-white/5 hover:border-ener-gold/50 transition-all duration-500 rounded-2xl" data-aos="fade-up-right">
                <div class="relative z-10 lg:pr-40">
                    <h2 class="text-white mb-4 text-2xl xl:text-3xl font-bold uppercase italic"> Collecte Automatisée des Données</h2>
                    <p class="text-gray-500 leading-relaxed">Le système collecte automatiquement les données électriques à partir des capteurs IoT.</p>
                </div>
                <div class="absolute right-0 top-0 transform transition-transform group-hover:scale-110 duration-500">
                    <img src="{{ asset('images/img_3.png') }}" class="w-[14rem] rounded-bl-[100%] opacity-40 group-hover:opacity-80" alt="Optimization">
                </div>
            </div>

            <div class="bg-[#121212] p-12 relative overflow-hidden group border border-white/5 hover:border-ener-gold/50 transition-all duration-500 rounded-2xl" data-aos="fade-up-left">
                <div class="relative z-10 lg:pl-40">
                    <h2 class="text-white mb-4 text-2xl xl:text-3xl font-bold uppercase italic text-right">Alertes 24/7</h2>
                    <p class="text-gray-500 leading-relaxed text-right">Recevez des notifications immédiates en cas de baisse de performance ou de panne détectée.</p>
                </div>
                <div class="absolute left-0 top-0 transform transition-transform group-hover:scale-110 duration-500">
                    <img src="{{ asset('images/img4.jpg') }}" class="w-[14rem] rounded-br-[100%] opacity-40 group-hover:opacity-80" alt="Alerts">
                </div>
            </div>

        </div>
    </section>
    <!-- features section end -->

    <!-- about section start-->
    <section class="py-32 px-8 xl:px-0 bg-[#0a0a0a]" id="about">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <div class="relative" data-aos="fade-down" data-aos-delay="400" data-aos-duration="1000" data-aos-easing="ease-out">
                    <div class="absolute -top-4 -left-4 w-24 h-24 border-t-2 border-l-2 border-ener-gold opacity-50"></div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 border-b-2 border-r-2 border-ener-gold opacity-50"></div>

                    <div class="relative overflow-hidden rounded-2xl border border-white/10">
                        <div class="relative w-full h-[550px]  rounded-[2rem]">
                            <video class="w-full h-full object-cover" autoplay muted loop playsinline>
                                <source src="{{ asset('videos/video_2.mp4') }}" type="video/mp4">
                            </video>

                            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/20 to-black/80 z-10"></div>
                        </div>
                        <div class="absolute bottom-0 left-0 w-full p-8 bg-gradient-to-t from-black/90 to-transparent ">
                            <div class="flex gap-8 z-20 relative">
                                <div>
                                    <span class="block text-3xl font-black text-ener-gold">100%</span>
                                    <span class="text-[10px] uppercase tracking-widest text-gray-400">Énergie Propre</span>
                                </div>
                                <div class="border-l border-white/10 pl-8">
                                    <span class="block text-3xl font-black text-white">24/7</span>
                                    <span class="text-[10px] uppercase tracking-widest text-gray-400">Monitoring</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000" data-aos-easing="ease-out">
                    <h3 class="text-ener-gold uppercase tracking-[0.4em] text-xs font-bold mb-4 italic">À Propos du EnerSol</h3>
                    <h2 class="text-4xl md:text-6xl font-black uppercase mb-8 leading-tight">Une solution intelligente pour <span class="italic font-light text-white/80"> une énergie plus intelligente.</span></h2>

                    <div class="space-y-6">
                        <p class="text-gray-400 leading-relaxed text-lg">
                            <strong>EnerSol</strong> est né d'une vision simple : rendre la gestion de l'énergie solaire accessible, intelligente et transparente. Nous avons conçu une plateforme qui fait le pont entre le hardware haute performance et une interface logicielle intuitive.
                        </p>

                        <p class="text-gray-400 leading-relaxed italic border-l-2 border-ener-gold pl-6">
                            « Notre mission est de transformer les données électriques brutes en informations utiles, afin d’aider les utilisateurs à mieux comprendre et optimiser leur consommation d’énergie pour un avenir plus durable. » </p>

                        <div class="grid grid-cols-2 gap-6 mt-12">
                            <div class="p-6 bg-[#121212] rounded-xl border border-white/5 hover:border-ener-gold/30 transition">
                                <i class="fas fa-microchip text-ener-gold mb-3 text-xl"></i>
                                <h4 class="text-white font-bold mb-2">Technologie IoT</h4>
                                <p class="text-xs text-gray-500">Intégration poussée avec ESP32 pour une précision maximale.</p>
                            </div>
                            <div class="p-6 bg-[#121212] rounded-xl border border-white/5 hover:border-ener-gold/30 transition">
                                <i class="fas fa-shield-alt text-ener-gold mb-3 text-xl"></i>
                                <h4 class="text-white font-bold mb-2">Sécurité Cloud</h4>
                                <p class="text-xs text-gray-500">Protection rigoureuse de vos données de consommation.</p>
                            </div>
                        </div>

                        <div class="pt-8">
                            <a href="#features" class="inline-flex items-center gap-3 text-ener-gold font-bold uppercase text-xs tracking-[0.2em] group">
                                Découvrir nos solutions
                                <span class="w-10 h-[1px] bg-ener-gold group-hover:w-16 transition-all"></span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- about section end-->

    <!-- footer section start-->
    <footer class="bg-[#070707] border-t border-white/5 pt-20 pb-10 px-8 xl:px-0">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">

                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center gap-2 mb-6">
                        <img src="{{ asset('images/logo.png') }}" class="w-[35px]" alt="EnerSol Logo">
                        <span class="text-white font-bold text-xl tracking-tighter uppercase italic">Ener<span class="text-[#FBB108]">Sol</span></span>
                    </div>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">
                        Expertise technique en gestion d'énergie solaire et solutions IoT pour un avenir durable.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-8 h-8 rounded-full border border-white/10 flex items-center justify-center text-white hover:border-[#FBB108] hover:text-[#FBB108] transition duration-300">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full border border-white/10 flex items-center justify-center text-white hover:border-[#FBB108] hover:text-[#FBB108] transition duration-300">
                            <i class="fa-brands fa-github"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-white font-bold uppercase text-xs tracking-[0.2em] mb-6">Navigation</h4>
                    <ul class="space-y-4">
                        <li><a href="" class="text-gray-500 hover:text-[#FBB108] text-sm transition">Home</a></li>
                        <li><a href="#features" class="text-gray-500 hover:text-[#FBB108] text-sm transition">Features</a></li>
                        <li><a href="#about" class="text-gray-500 hover:text-[#FBB108] text-sm transition">About Us</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold uppercase text-xs tracking-[0.2em] mb-6">Plateforme</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('login') }}" class="text-gray-500 hover:text-[#FBB108] text-sm transition">Connexion</a></li>
                        <li><a href="{{ route('register') }}" class="text-gray-500 hover:text-[#FBB108] text-sm transition">S'inscrire</a></li>
                        <li><span class="flex items-center gap-2 text-sm text-gray-500">
                                <i class="fa-solid fa-sun text-[#FBB108]"></i>Bienvenue sur EnerSol
                            </span></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold uppercase text-xs tracking-[0.2em] mb-6">Contact Tech</h4>
                    <ul class="space-y-4 text-sm text-gray-500">
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-envelope text-[#FBB108] mt-1"></i>
                            <span>support@enersol.tech</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-location-dot text-[#FBB108] mt-1"></i>
                            <span>Oujda, Maroc</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-white/5 pt-10 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-[10px] text-gray-600 uppercase tracking-widest text-center md:text-left">
                    &copy; {{ date('Y') }} EnerSol -Intelligent Solar Energy Platform
                </p>
                <div class="flex gap-8">
                    <a href="#" class="text-[10px] text-gray-600 hover:text-white transition uppercase tracking-tighter">Privacy Policy</a>
                    <a href="#" class="text-[10px] text-gray-600 hover:text-white transition uppercase tracking-tighter">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer section end-->

    <!-- js start-->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            easing: 'ease-out-quad',
        });
    </script>

 
</body>

</html>