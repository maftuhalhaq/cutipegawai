<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - SI-CUTE BNN Kab. Malang</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts (Tailwind CSS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom UI Animations -->
    <style>
        .animate-fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .animate-fade-in-left {
            animation: fadeInLeft 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .animation-delay-100 { animation-delay: 100ms; }
        .animation-delay-200 { animation-delay: 200ms; }
        .animation-delay-300 { animation-delay: 300ms; }
        .animation-delay-400 { animation-delay: 400ms; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
            100% { transform: translateY(0px); }
        }

        /* Trik jika gambar logo JPG memiliki background hitam, ini akan membuatnya transparan ke biru */
        .blend-screen { mix-blend-mode: screen; }
    </style>
</head>
<body class="font-sans text-slate-900 dark:text-slate-100 antialiased bg-slate-100/80 dark:bg-slate-950 selection:bg-blue-600 selection:text-white transition-colors duration-300">
    <!-- Background overlay -->
    <div class="min-h-screen flex items-center justify-center p-4 sm:p-8">

        <!-- Mac UI Window Container -->
        <div class="w-full max-w-[1050px] min-h-[600px] bg-white dark:bg-slate-800 rounded-[2rem] shadow-2xl shadow-slate-300/60 dark:shadow-black/50 overflow-hidden flex flex-col border border-slate-200/80 dark:border-slate-700/80 animate-fade-in-up opacity-0 transition-colors duration-300">

            <!-- Mac Window Top Bar -->
            <div class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200/80 dark:border-slate-700/80 px-6 py-3 flex items-center justify-between transition-colors duration-300">
                <div class="flex space-x-2.5">
                    <div class="w-3 h-3 rounded-full bg-red-500 shadow-sm border border-red-600/20"></div>
                    <div class="w-3 h-3 rounded-full bg-yellow-400 shadow-sm border border-yellow-500/20"></div>
                    <div class="w-3 h-3 rounded-full bg-green-500 shadow-sm border border-green-600/20"></div>
                </div>
                <div class="text-xs text-slate-500 dark:text-slate-400 font-semibold flex items-center transition-colors duration-300">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Portal Cuti Digital BNN Kab. Malang
                </div>
                <div class="text-[10px] font-bold text-slate-500 dark:text-slate-300 bg-slate-200/70 dark:bg-slate-700/70 px-3 py-1 rounded-full tracking-wide transition-colors duration-300">
                    v2.6 • ASN Online
                </div>
            </div>

            <!-- Main Content Split -->
            <div class="flex flex-col md:flex-row flex-1">

                <!-- Left Panel (Blue Branding) -->
                <div class="md:w-[45%] bg-gradient-to-br from-blue-600 to-blue-700 dark:from-slate-800 dark:to-slate-900 text-white p-10 flex flex-col justify-between relative overflow-hidden transition-colors duration-300">

                    <!-- Top Logo (Tengah) -->
                    <div class="flex items-center justify-center w-full space-x-4 z-10 animate-fade-in-up opacity-0">
                        <img src="{{ asset('images/logo-bnn.png') }}" alt="Logo BNN" class="w-16 h-16 object-contain blend-screen drop-shadow-xl">
                        <div class="leading-tight text-left">
                            <div class="text-2xl font-bold tracking-wider text-blue-100/90 dark:text-slate-200">OFFICIAL PORTAL</div>
                            <div class="text-2xl font-bold tracking-wider dark:text-white">BNN Kab. Malang</div>
                        </div>
                    </div>

                    <!-- Center Illustration & Title -->
                    <div class="flex flex-col items-center justify-center mt-12 mb-8 z-10">
                        <div class="relative animate-float">
                            <!-- Glow Effect di belakang gambar -->
                            <div class="absolute inset-0 bg-blue-400 dark:bg-blue-500/20 blur-[40px] opacity-40 rounded-full scale-110"></div>
                            <img src="{{ asset('images/ilustrasi-login.png') }}" alt="Ilustrasi Login" class="relative w-64 h-64 object-cover rounded-3xl shadow-2xl border-[6px] border-white/10 dark:border-slate-700/50 mb-8 transition-transform duration-500 hover:scale-105">
                        </div>
                        <h1 class="text-[2.5rem] font-extrabold tracking-tight mb-1 opacity-0 animate-fade-in-up animation-delay-100 dark:text-white">SI-CUTE</h1>

                        <p class="text-blue-100 dark:text-slate-300 font-medium text-lg opacity-0 animate-fade-in-up animation-delay-200">
                            <span class="font-bold">S</span>istem <span class="font-bold">I</span>nformasi <span class="font-bold">CUT</span>i <span class="font-bold">E</span>lektronik
                        </p>

                        <div class="mt-5 px-5 py-2 border border-blue-300/30 dark:border-slate-600/50 rounded-full text-xs font-semibold tracking-wide bg-blue-500/20 dark:bg-slate-800/50 backdrop-blur-md opacity-0 animate-fade-in-up animation-delay-300 transition-colors hover:bg-blue-500/40 dark:hover:bg-slate-700/50 cursor-default">
                            Badan Narkotika Nasional Kab. Malang
                        </div>
                    </div>

                    <!-- Bottom Status -->
                    <div class="flex justify-between items-center text-xs font-medium text-blue-200 dark:text-slate-400 z-10 opacity-0 animate-fade-in-up animation-delay-400">
                        <div class="flex items-center">
                            <div class="w-2.5 h-2.5 bg-green-400 rounded-full mr-2.5 animate-pulse shadow-[0_0_8px_rgba(74,222,128,0.6)]"></div>
                            Server Aktif & Terhubung
                        </div>
                        <div>Layanan 24/7</div>
                    </div>

                    <!-- Decorative Background Elements -->
                    <div class="absolute top-0 right-0 -mr-16 -mt-16 w-72 h-72 rounded-full bg-blue-500/30 dark:bg-blue-500/10 blur-3xl transition-colors duration-300"></div>
                    <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-72 h-72 rounded-full bg-blue-800/30 dark:bg-blue-900/20 blur-3xl transition-colors duration-300"></div>
                </div>

                <!-- Right Panel (Login Form) -->
                <div class="md:w-[55%] p-10 md:p-14 bg-white dark:bg-slate-800 flex flex-col justify-center transition-colors duration-300">

                    <div class="max-w-[400px] w-full mx-auto">
                        <!-- Autentikasi Badge -->
                        <div class="inline-flex items-center px-3.5 py-1.5 rounded-full bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800/50 text-blue-600 dark:text-blue-400 text-xs font-bold mb-6 opacity-0 animate-fade-in-left transition-colors duration-300">
                            <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            Autentikasi Pegawai
                        </div>

                        <h2 class="text-[2rem] font-extrabold text-slate-800 dark:text-white mb-2 tracking-tight opacity-0 animate-fade-in-left animation-delay-100 transition-colors duration-300">Selamat Datang!</h2>
                        <p class="text-slate-500 dark:text-slate-400 text-sm mb-8 leading-relaxed pr-4 opacity-0 animate-fade-in-left animation-delay-200 transition-colors duration-300">Silakan masuk untuk mengelola data cuti pegawai BNN Kabupaten Malang secara terintegrasi.</p>

                        <!-- Session Status (Blade murni) -->
                        @if (session('status'))
                            <div class="mb-5 p-3.5 rounded-xl bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400 text-sm font-medium border border-green-200 dark:border-green-800/50 shadow-sm animate-fade-in-left transition-colors duration-300">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- FORM ACTION DIKUNCI KE /login -->
                        <form method="POST" action="/login" class="space-y-5 opacity-0 animate-fade-in-left animation-delay-300">
                            @csrf

                            <!-- Username -->
                            <div>
                                <label for="username" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 transition-colors duration-300">Username</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none transition-colors duration-300 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-400 text-slate-400 dark:text-slate-500">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                    <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus class="block w-full pl-11 pr-4 py-3 bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-800 dark:text-white focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-blue-600/10 dark:focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 hover:bg-white dark:hover:bg-slate-900/80 transition-all duration-300 sm:text-sm shadow-sm" placeholder="admin">
                                </div>
                                @error('username')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 font-medium transition-colors duration-300">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <div class="flex justify-between items-center mb-1.5">
                                    <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 transition-colors duration-300">Kata Sandi</label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-xs font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors duration-300">Lupa Sandi?</a>
                                    @endif
                                </div>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none transition-colors duration-300 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-400 text-slate-400 dark:text-slate-500">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    </div>
                                    <input id="password" type="password" name="password" required class="block w-full pl-11 pr-10 py-3 bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-800 dark:text-white focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-blue-600/10 dark:focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 hover:bg-white dark:hover:bg-slate-900/80 transition-all duration-300 sm:text-sm shadow-sm" placeholder="••••••••">
                                </div>
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 font-medium transition-colors duration-300">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Remember Me & SSL -->
                            <div class="flex items-center justify-between mt-5">
                                <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-blue-600 shadow-sm focus:ring-blue-600 dark:focus:ring-blue-500 w-4 h-4 cursor-pointer transition-all duration-300">
                                    <span class="ml-2.5 text-sm font-medium text-slate-600 dark:text-slate-400 group-hover:text-slate-800 dark:group-hover:text-slate-200 transition-colors">Ingat sesi ini</span>
                                </label>
                                <div class="flex items-center text-[11px] font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-100 dark:border-emerald-800/30 px-2.5 py-1 rounded-md transition-colors duration-300">
                                    <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></div>
                                    Enkripsi SSL
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-3">
                                <button type="submit" class="group w-full flex justify-center items-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-blue-600/30 dark:shadow-blue-900/20 text-sm font-bold text-white bg-blue-600 dark:bg-blue-600 hover:bg-blue-700 dark:hover:bg-blue-500 hover:shadow-blue-600/50 dark:hover:shadow-blue-500/30 hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-blue-600/20 transition-all duration-300 active:scale-[0.98]">
                                    Masuk ke Sistem
                                    <svg class="ml-2 w-4 h-4 transition-transform duration-300 group-hover:translate-x-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </button>
                            </div>
                        </form>

                        <!-- Info Alert -->
                        <div class="mt-8 bg-blue-50/60 dark:bg-blue-900/10 border border-blue-100/80 dark:border-blue-800/30 rounded-2xl p-4 flex items-start hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors duration-300 opacity-0 animate-fade-in-left animation-delay-400">
                            <div class="shrink-0 mt-0.5">
                                <svg class="h-5 w-5 text-blue-600 dark:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-[11px] sm:text-xs text-blue-800/90 dark:text-blue-300/90 leading-relaxed font-medium transition-colors duration-300">
                                    Akses sistem ini diperuntukkan khusus bagi ASN & staf di lingkungan BNN Kabupaten Malang. Pastikan menjaga kerahasiaan kredensial Anda.
                                </p>
                            </div>
                        </div>

                        <!-- Copyright -->
                        <div class="mt-8 text-center opacity-0 animate-fade-in-left animation-delay-400">
                            <p class="text-[11px] text-slate-400 dark:text-slate-500 font-medium transition-colors duration-300">
                                &copy; 2026 BNN Kabupaten Malang. Sistem Informasi CUTi Elektronik.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
