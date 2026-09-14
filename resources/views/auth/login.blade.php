<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SI-CUTE BNNK Malang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        /* Animasi Ringan (Floating) untuk Ilustrasi agar terasa hidup */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 5s ease-in-out infinite;
        }

        /* Latar Belakang Kiri (Gradasi Biru Modern selaras dengan BNN) */
        .bg-gradient-modern {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex text-slate-800">

    <!-- SISI KIRI: ILUSTRASI & BRANDING -->
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-modern relative items-center justify-center p-12 overflow-hidden">
        <!-- Ornamen Geometris Transparan di Background -->
        <div class="absolute top-[-10%] left-[-10%] w-64 h-64 bg-white opacity-10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-blue-300 opacity-20 rounded-full blur-3xl"></div>

        <div class="relative z-10 w-full max-w-lg text-center flex flex-col items-center">
            
            <!-- GAMBAR ILUSTRASI KARTUN PEGAWAI BAWA BERKAS -->
            <div class="relative mb-8 animate-float">
                <div class="absolute -inset-1 bg-white/20 rounded-3xl blur-md"></div>
                <img src="{{ asset('images/ilustrasi-login.png') }}" 
                     alt="Ilustrasi Pegawai Membawa Berkas Cuti" 
                     class="relative w-80 h-auto rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.5)] border-4 border-white/30 object-cover">
            </div>
            
            <!-- Tipografi Branding Aplikasi -->
<h1 class="text-4xl font-bold text-white tracking-widest drop-shadow-md mb-3">SI-CUTE</h1>
<p class="text-blue-100 text-lg font-medium tracking-wide leading-relaxed">
    <span class="font-bold text-white">S</span>istem 
    <span class="font-bold text-white">I</span>nformasi 
    <span class="font-bold text-white">CUT</span>i 
    <span class="font-bold text-white">E</span>lektronik <br>
    <span class="text-white font-bold">Badan Narkotika Nasional Kab. Malang</span>
</p>
        </div>
    </div>

    <!-- SISI KANAN: FORM LOGIN -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white shadow-2xl z-10 lg:rounded-l-[3rem]">
        <div class="max-w-md w-full">
            
            <!-- Logo & Judul Mobile -->
            <div class="text-center mb-10 lg:text-left">
                <div class="inline-flex items-center justify-center bg-blue-50 p-3 rounded-2xl shadow-sm mb-4 lg:hidden">
                    <svg class="w-8 h-8 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h2 class="text-3xl font-bold text-slate-900">Selamat Datang! </h2>
                <p class="text-slate-500 mt-2 text-sm">Silakan masuk untuk mengelola data cuti pegawai BNN Kabupaten Malang.</p>
            </div>

            <!-- Pesan Error / Success -->
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 text-emerald-600 px-4 py-3 rounded-xl text-sm font-semibold flex items-center gap-3 border border-emerald-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 bg-red-50 text-red-600 px-4 py-3 rounded-xl text-sm font-semibold flex items-center gap-3 border border-red-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Form -->
            <form action="{{ url('/login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Username</label>
                    <div class="relative">
                        <!-- Icon User (Menggantikan Icon Email) -->
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <input type="text" name="username" value="{{ old('username') }}" required class="w-full pl-11 pr-4 py-3.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm transition-all bg-slate-50 focus:bg-white" placeholder="Masukkan username...">
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Kata Sandi</label>
                    <div class="relative">
                        <!-- Icon Password -->
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        
                        <!-- Input Password (diberi ID dan padding kanan lebih besar) -->
                        <input type="password" id="input_password" name="password" required class="w-full pl-11 pr-12 py-3.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm transition-all bg-slate-50 focus:bg-white" placeholder="••••••••">
                        
                        <!-- Tombol Show/Hide Password -->
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-blue-600 transition-colors focus:outline-none">
                            <svg id="eye_icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <!-- Ikon Mata Default (Tertutup/Sandi tersembunyi) -->
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl shadow-md transition-all hover:shadow-lg mt-6 flex items-center justify-center gap-2">
                    Masuk ke Sistem
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>
            
            <!-- Footer -->
            <div class="mt-10 text-center">
                <p class="text-xs text-slate-400 font-medium">
                    &copy; {{ date('Y') }} BNN Kabupaten Malang.<br>Sistem Informasi CUTi Elektronik.
                </p>
            </div>
        </div>
    </div>

    <!-- SCRIPT UNTUK TOGGLE SHOW/HIDE PASSWORD -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('input_password');
            const eyeIcon = document.getElementById('eye_icon');

            if (passwordInput.type === 'password') {
                // Ubah menjadi teks terlihat
                passwordInput.type = 'text';
                // Ubah ke SVG Mata Tercoret (Sandi terlihat)
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                `;
            } else {
                // Kembalikan menjadi titik-titik (password)
                passwordInput.type = 'password';
                // Kembalikan ke SVG Mata Terbuka (Sandi tersembunyi)
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                `;
            }
        }
    </script>
</body>
</html>