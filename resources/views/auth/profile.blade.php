<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pengaturan Profil & Keamanan - SI-CUTE</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts (Tailwind CSS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom UI Animations -->
    <style>
        body { font-family: 'figtree', sans-serif; }
        .animate-fade-in-up { animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .animation-delay-100 { animation-delay: 100ms; }
        .animation-delay-200 { animation-delay: 200ms; }
        .animation-delay-300 { animation-delay: 300ms; }
        .animation-delay-400 { animation-delay: 400ms; }
        .animation-delay-500 { animation-delay: 500ms; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 20px; }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #334155; }
    </style>
</head>
<body class="bg-slate-100/80 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased selection:bg-blue-600 selection:text-white transition-colors duration-300">

    <!-- Background overlay -->
    <div class="min-h-screen flex items-center justify-center p-4 sm:p-8">

        <!-- Mac UI Window Container -->
        <div class="w-full max-w-[1150px] bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl dark:shadow-[0_20px_50px_rgba(0,0,0,0.6)] overflow-hidden flex flex-col border border-slate-200/80 dark:border-slate-800 animate-fade-in-up opacity-0 transition-colors duration-300">

            <!-- Mac Window Top Bar -->
            <div class="bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800/60 px-6 py-3.5 flex items-center justify-between transition-colors duration-300">
                <!-- Left: Mac Buttons & Back Link -->
                <div class="flex items-center space-x-6 w-1/3">
                    <div class="flex items-center gap-1.5">
                        <div class="w-3 h-3 rounded-full bg-red-500 shadow-inner"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-400 shadow-inner"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500 shadow-inner"></div>
                    </div>
                    <a href="{{ route('dashboard') }}" class="flex items-center text-xs font-semibold text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors group">
                        <svg class="w-4 h-4 mr-1.5 text-slate-400 dark:text-slate-500 group-hover:text-blue-600 dark:group-hover:text-blue-400 group-hover:-translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Dashboard
                    </a>
                </div>

                <!-- Center: App Title -->
                <div class="flex items-center justify-center w-1/3 text-xs font-bold text-slate-600 dark:text-slate-300 transition-colors duration-300">
    <img src="{{ asset('images/logo-bnn.png') }}" alt="Logo BNN" class="w-5 h-5 object-contain mr-2 drop-shadow-sm">
    SI-CUTE <span class="text-slate-300 dark:text-slate-600 mx-2">•</span> Pengaturan Profil & Keamanan
</div>

                <!-- Right: Version & User Info -->
                <div class="flex items-center justify-end w-1/3 space-x-4">
                    <div class="text-[10px] font-bold text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-800 px-2.5 py-1 rounded-md tracking-wide hidden sm:block transition-colors duration-300">
                        v2.6 • ASN Online
                    </div>
                    <div class="flex items-center space-x-3 border-l border-slate-200 dark:border-slate-700 pl-4 transition-colors duration-300">
                        <div class="text-right hidden sm:block">
                            <div class="text-xs font-bold text-slate-700 dark:text-slate-200">{{ $user->name ?? 'Admin' }}</div>
                            <div class="text-[10px] font-medium text-slate-500 dark:text-slate-400">Kepegawaian BNN</div>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-sm font-bold shadow-md border border-blue-100 dark:border-blue-900">
                            {{ substr($user->name ?? 'A', 0, 1) }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header Content -->
            <div class="px-8 sm:px-12 pt-8 pb-5 flex flex-col sm:flex-row sm:justify-between sm:items-end border-b border-slate-100 dark:border-slate-800/60 opacity-0 animate-fade-in-up animation-delay-100 transition-colors duration-300">
                <div>
                    <div class="text-[10px] font-bold text-slate-400 dark:text-slate-500 mb-2 uppercase tracking-wider">
                        Beranda / Akun Pegawai / <span class="text-blue-600 dark:text-blue-500">Pengaturan Profil & Keamanan</span>
                    </div>
                    <h1 class="text-[2rem] font-extrabold text-slate-800 dark:text-white tracking-tight leading-none mb-2">Pengaturan Profil & Keamanan</h1>
                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Konfigurasi identitas akun administrator, pembaruan kata sandi, serta otorisasi ganda untuk hak akses cuti dan mutasi pegawai.</p>
                </div>
                <div class="mt-4 sm:mt-0 flex items-center px-3 py-1.5 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 rounded-full text-[11px] font-bold border border-emerald-100/80 dark:border-emerald-800/30 shadow-sm shrink-0 transition-colors duration-300">
                    <div class="w-2 h-2 rounded-full bg-emerald-500 mr-2 animate-pulse shadow-[0_0_6px_rgba(16,185,129,0.6)]"></div>
                    Sesi Aman Aktif
                </div>
            </div>

            <!-- Main Scrollable Area -->
            <div class="p-8 sm:px-12 sm:py-8 bg-slate-50/50 dark:bg-slate-900/50 flex-1 overflow-y-auto custom-scrollbar transition-colors duration-300">

                <!-- Alerts -->
                @if(session('success'))
                <div class="mb-6 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 px-4 py-3 rounded-xl shadow-sm border border-emerald-200/80 dark:border-emerald-500/20 flex items-center gap-3 font-medium text-sm animate-fade-in-up">
                    <div class="bg-emerald-500 text-white p-1.5 rounded-full"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg></div>
                    {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                <div class="mb-6 bg-rose-50 dark:bg-rose-500/10 text-rose-700 dark:text-rose-400 px-4 py-3 rounded-xl shadow-sm border border-rose-200/80 dark:border-rose-500/20 flex items-center gap-3 font-medium text-sm animate-fade-in-up">
                    <div class="bg-rose-500 text-white p-1.5 rounded-full"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg></div>
                    {{ session('error') }}
                </div>
                @endif
                @if($errors->any())
                <div class="mb-6 bg-rose-50 dark:bg-rose-500/10 text-rose-700 dark:text-rose-400 px-4 py-3 rounded-xl shadow-sm border border-rose-200/80 dark:border-rose-500/20 flex items-center gap-3 font-medium text-sm animate-fade-in-up">
                    <div class="bg-rose-500 text-white p-1.5 rounded-full"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg></div>
                    {{ $errors->first() }}
                </div>
                @endif

                <!-- Grid Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                    <!-- KOLOM KIRI -->
                    <div class="space-y-8">

                        <!-- CARD 1: INFORMASI AKUN -->
                        <div class="bg-white dark:bg-[#111827] p-7 rounded-[1.5rem] shadow-sm hover:shadow-md border border-slate-200/80 dark:border-slate-800 transition-all duration-300 opacity-0 animate-fade-in-up animation-delay-200 relative overflow-hidden group">

                            <div class="flex justify-between items-start mb-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-[#0f172a] text-blue-600 dark:text-blue-500 flex items-center justify-center border border-blue-100 dark:border-slate-800 group-hover:scale-105 transition-transform duration-300 shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-lg text-slate-800 dark:text-white">Informasi Akun</h3>
                                        <p class="text-[10px] text-slate-500 dark:text-slate-400 font-medium mt-0.5">Kredensial dan data dasar pengguna aktif</p>
                                    </div>
                                </div>
                                <div class="bg-slate-50 dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400 text-[9px] font-bold px-3 py-1.5 rounded-lg tracking-wider uppercase transition-colors duration-300">
                                    Role: Administrator
                                </div>
                            </div>

                            <form action="{{ route('profil.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="action" value="update_profile">

                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1.5">Nama Lengkap</label>
                                        <div class="relative">
                                            <input type="text" name="name" value="{{ $user->name }}" required class="w-full pl-4 pr-10 py-2.5 border border-slate-200 dark:border-slate-800 bg-white dark:bg-[#0f172a] rounded-xl text-sm font-bold text-slate-800 dark:text-slate-200 focus:ring-4 focus:ring-blue-600/10 dark:focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 outline-none transition-all shadow-sm">
                                            <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none">
                                                <svg class="w-3.5 h-3.5 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1.5">Username Login</label>
                                        <div class="relative">
                                            <input type="text" name="username" value="{{ $user->username }}" required class="w-full pl-4 pr-10 py-2.5 border border-slate-200 dark:border-slate-800 bg-white dark:bg-[#0f172a] rounded-xl text-sm font-bold text-slate-800 dark:text-slate-200 focus:ring-4 focus:ring-blue-600/10 dark:focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 outline-none transition-all shadow-sm">
                                            <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none">
                                                <svg class="w-4 h-4 text-emerald-500 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                            </div>
                                        </div>
                                        <p class="text-[9px] text-slate-400 dark:text-slate-500 mt-1.5 font-medium">Username digunakan sebagai identitas otentikasi tunggal sistem SI-CUTE.</p>
                                    </div>

                                    <div class="pt-2">
                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white w-full py-2.5 rounded-xl text-xs font-bold shadow-md shadow-blue-600/20 dark:shadow-none transition-all active:scale-95 flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                            Simpan Perubahan Akun
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- CARD 2: UBAH KATA SANDI -->
                        <div class="bg-white dark:bg-[#111827] p-7 rounded-[1.5rem] shadow-sm hover:shadow-md border border-slate-200/80 dark:border-slate-800 transition-all duration-300 opacity-0 animate-fade-in-up animation-delay-400 relative group">

                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-[#0f172a] text-slate-600 dark:text-slate-400 flex items-center justify-center border border-slate-200 dark:border-slate-800 group-hover:scale-105 transition-transform duration-300 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-slate-800 dark:text-white">Ubah Kata Sandi</h3>
                                    <p class="text-[10px] text-slate-500 dark:text-slate-400 font-medium mt-0.5">Perbarui kata sandi akun secara berkala</p>
                                </div>
                            </div>

                            <form action="{{ route('profil.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="action" value="update_password">

                                <div class="space-y-4">
                                    <div>
                                        <div class="flex justify-between items-center mb-1.5">
                                            <label class="block text-[11px] font-bold text-rose-600 dark:text-rose-500">Kata Sandi Lama (Verifikasi)</label>
                                            <span class="text-[9px] text-rose-500 dark:text-rose-400 font-bold bg-white dark:bg-[#0f172a] border border-rose-100 dark:border-rose-900/30 px-2 py-0.5 rounded">Wajib Diisi</span>
                                        </div>
                                        <div class="relative">
                                            <input type="password" name="old_password" required class="w-full pl-4 pr-10 py-2.5 border border-rose-200 dark:border-rose-900/50 bg-white dark:bg-[#0f172a] rounded-xl text-sm font-medium text-rose-900 dark:text-rose-200 placeholder-slate-300 dark:placeholder-slate-600 focus:ring-4 focus:ring-rose-600/10 dark:focus:ring-rose-500/20 focus:border-rose-500 outline-none transition-all shadow-sm" placeholder="Ketik kata sandi saat ini">
                                            <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none">
                                                <svg class="w-3.5 h-3.5 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1.5">Kata Sandi Baru</label>
                                            <input type="password" name="new_password" required class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-800 bg-white dark:bg-[#0f172a] rounded-xl text-sm font-medium text-slate-800 dark:text-slate-200 placeholder-slate-300 dark:placeholder-slate-600 focus:ring-4 focus:ring-blue-600/10 dark:focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all shadow-sm" placeholder="Minimal 8 karakter">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1.5">Ulangi Sandi Baru</label>
                                            <input type="password" name="new_password_confirmation" required class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-800 bg-white dark:bg-[#0f172a] rounded-xl text-sm font-medium text-slate-800 dark:text-slate-200 placeholder-slate-300 dark:placeholder-slate-600 focus:ring-4 focus:ring-blue-600/10 dark:focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all shadow-sm" placeholder="Konfirmasi sandi">
                                        </div>
                                    </div>

                                    <div class="pt-2">
                                        <button type="submit" class="bg-slate-800 dark:bg-slate-700 hover:bg-slate-900 dark:hover:bg-slate-600 text-white w-full py-2.5 rounded-xl text-xs font-bold shadow-md shadow-slate-800/20 dark:shadow-none transition-all active:scale-95">
                                            Update Kata Sandi
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- KOLOM KANAN (AREA PIN) -->
                    <div class="space-y-8">

                        <!-- CARD 3: PIN ATUR HAK CUTI -->
                        <div class="bg-white dark:bg-[#111827] p-7 rounded-[1.5rem] shadow-sm hover:shadow-md border border-slate-200/80 dark:border-slate-800 border-t-[5px] border-t-purple-500 dark:border-t-purple-500 transition-all duration-300 opacity-0 animate-fade-in-up animation-delay-300 relative overflow-hidden group">

                            <!-- Watermark Icon -->
                            <div class="absolute -right-4 -top-4 opacity-[0.03] dark:opacity-[0.05] group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-500 pointer-events-none">
                                <svg class="w-32 h-32 text-purple-900 dark:text-purple-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C9.243 2 7 4.243 7 7v3H6a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2v-8a2 2 0 00-2-2h-1V7c0-2.757-2.243-5-5-5z"></path></svg>
                            </div>

                            <h3 class="font-extrabold text-lg text-purple-700 dark:text-purple-400 mb-0.5 flex items-center gap-2 relative z-10">
                                🔒 PIN Atur Hak Cuti
                            </h3>
                            <p class="text-[10px] font-medium text-slate-500 dark:text-slate-400 mb-6 relative z-10">Gunakan untuk otorisasi saat menyimpan pengaturan sisa cuti pegawai.</p>

                            <form action="{{ route('profil.update') }}" method="POST" class="relative z-10">
                                @csrf
                                <input type="hidden" name="action" value="update_pin_cuti">

                                <div class="space-y-4">
                                    <div>
                                        <div class="flex justify-between items-center mb-1.5">
                                            <label class="block text-[11px] font-bold text-rose-600 dark:text-rose-500">Verifikasi Kata Sandi Akun</label>
                                            <span class="text-[9px] text-rose-500 dark:text-rose-400 font-bold bg-white dark:bg-[#0f172a] border border-rose-100 dark:border-rose-900/30 px-2 py-0.5 rounded">Wajib Diisi</span>
                                        </div>
                                        <div class="relative">
                                            <input type="password" name="password_verify" required class="w-full pl-4 pr-10 py-2.5 border border-rose-200 dark:border-rose-900/50 bg-white dark:bg-[#0f172a] rounded-xl text-sm font-medium text-rose-900 dark:text-rose-200 placeholder-slate-300 dark:placeholder-slate-600 focus:ring-4 focus:ring-rose-600/10 dark:focus:ring-rose-500/20 focus:border-rose-500 outline-none transition-all shadow-sm" placeholder="Ketik kata sandi akun untuk validasi">
                                            <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none">
                                                <svg class="w-3.5 h-3.5 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1.5">PIN 6-Digit Baru</label>
                                            <input type="password" name="pin_cuti" maxlength="6" required class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-800 bg-white dark:bg-[#0f172a] rounded-xl focus:ring-4 focus:ring-purple-600/10 dark:focus:ring-purple-500/20 focus:border-purple-500 outline-none tracking-[0.5em] text-center font-mono text-lg text-slate-800 dark:text-slate-200 shadow-sm transition-all placeholder:tracking-normal placeholder:text-sm placeholder:text-slate-300 dark:placeholder:text-slate-600" placeholder="••••••">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1.5">Ulangi PIN Cuti</label>
                                            <input type="password" name="pin_cuti_confirmation" maxlength="6" required class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-800 bg-white dark:bg-[#0f172a] rounded-xl focus:ring-4 focus:ring-purple-600/10 dark:focus:ring-purple-500/20 focus:border-purple-500 outline-none tracking-[0.5em] text-center font-mono text-lg text-slate-800 dark:text-slate-200 shadow-sm transition-all placeholder:tracking-normal placeholder:text-sm placeholder:text-slate-300 dark:placeholder:text-slate-600" placeholder="••••••">
                                        </div>
                                    </div>

                                    <div class="pt-2">
                                        <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2.5 rounded-xl text-xs font-bold shadow-md shadow-purple-600/20 dark:shadow-none transition-all active:scale-[0.98]">
                                            Simpan PIN Hak Cuti
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- CARD 4: PIN HAPUS PEGAWAI -->
                        <div class="bg-white dark:bg-[#111827] p-7 rounded-[1.5rem] shadow-sm hover:shadow-md border border-slate-200/80 dark:border-slate-800 border-t-[5px] border-t-rose-500 dark:border-t-rose-500 transition-all duration-300 opacity-0 animate-fade-in-up animation-delay-500 relative overflow-hidden group">

                            <!-- Watermark Icon -->
                            <div class="absolute -right-2 -top-2 opacity-[0.03] dark:opacity-[0.05] group-hover:scale-110 group-hover:rotate-3 transition-transform duration-500 pointer-events-none">
                                <svg class="w-32 h-32 text-rose-900 dark:text-rose-400" fill="currentColor" viewBox="0 0 24 24"><path d="M6 7H5v13a2 2 0 002 2h10a2 2 0 002-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path></svg>
                            </div>

                            <div class="flex items-center gap-2.5 mb-1 relative z-10">
                                <h3 class="font-extrabold text-lg text-rose-600 dark:text-rose-400 flex items-center gap-1.5">
                                    <div class="w-2 h-2 bg-rose-500 rounded-full animate-pulse shadow-[0_0_6px_rgba(244,63,94,0.6)]"></div>
                                    PIN Hapus Pegawai
                                </h3>
                                <span class="bg-white dark:bg-[#0f172a] text-slate-500 dark:text-slate-400 border border-slate-200 dark:border-slate-700 text-[8px] font-bold px-2 py-0.5 rounded uppercase tracking-wider transition-colors duration-300">Otorisasi Kritis</span>
                            </div>
                            <p class="text-[10px] font-medium text-slate-500 dark:text-slate-400 mb-6 relative z-10">Otorisasi khusus untuk menghapus data pegawai secara permanen.</p>

                            <form action="{{ route('profil.update') }}" method="POST" class="relative z-10">
                                @csrf
                                <input type="hidden" name="action" value="update_pin_hapus">

                                <div class="space-y-4">
                                    <div>
                                        <div class="flex justify-between items-center mb-1.5">
                                            <label class="block text-[11px] font-bold text-rose-600 dark:text-rose-500">Verifikasi Kata Sandi Akun</label>
                                            <span class="text-[9px] text-rose-500 dark:text-rose-400 font-bold bg-white dark:bg-[#0f172a] border border-rose-100 dark:border-rose-900/30 px-2 py-0.5 rounded">Wajib Diisi</span>
                                        </div>
                                        <div class="relative">
                                            <input type="password" name="password_verify" required class="w-full pl-4 pr-10 py-2.5 border border-rose-200 dark:border-rose-900/50 bg-white dark:bg-[#0f172a] rounded-xl text-sm font-medium text-rose-900 dark:text-rose-200 placeholder-slate-300 dark:placeholder-slate-600 focus:ring-4 focus:ring-rose-600/10 dark:focus:ring-rose-500/20 focus:border-rose-500 outline-none transition-all shadow-sm" placeholder="Ketik kata sandi akun untuk validasi">
                                            <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none">
                                                <svg class="w-3.5 h-3.5 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1.5">PIN 6-Digit Baru</label>
                                            <input type="password" name="pin_hapus" maxlength="6" required class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-800 bg-white dark:bg-[#0f172a] rounded-xl focus:ring-4 focus:ring-rose-600/10 dark:focus:ring-rose-500/20 focus:border-rose-500 outline-none tracking-[0.5em] text-center font-mono text-lg text-slate-800 dark:text-slate-200 shadow-sm transition-all placeholder:tracking-normal placeholder:text-sm placeholder:text-slate-300 dark:placeholder:text-slate-600" placeholder="••••••">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1.5">Ulangi PIN Hapus</label>
                                            <input type="password" name="pin_hapus_confirmation" maxlength="6" required class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-800 bg-white dark:bg-[#0f172a] rounded-xl focus:ring-4 focus:ring-rose-600/10 dark:focus:ring-rose-500/20 focus:border-rose-500 outline-none tracking-[0.5em] text-center font-mono text-lg text-slate-800 dark:text-slate-200 shadow-sm transition-all placeholder:tracking-normal placeholder:text-sm placeholder:text-slate-300 dark:placeholder:text-slate-600" placeholder="••••••">
                                        </div>
                                    </div>

                                    <div class="pt-2">
                                        <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white py-2.5 rounded-xl text-xs font-bold shadow-md shadow-rose-600/20 dark:shadow-none transition-all active:scale-[0.98]">
                                            Simpan PIN Hapus
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-slate-50 dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800/80 px-8 sm:px-12 py-4 flex flex-col sm:flex-row justify-between items-center opacity-0 animate-fade-in-up animation-delay-500 transition-colors duration-300">
                <div class="flex items-center text-[10px] text-slate-500 dark:text-slate-400 font-semibold space-x-3 mb-3 sm:mb-0 transition-colors duration-300">
                    <span class="flex items-center text-emerald-600 dark:text-emerald-500"><div class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></div> Terenkripsi AES-256 GCM</span>
                    <span class="border-l border-slate-300 dark:border-slate-700 pl-3">IP Akses Terdaftar: {{ request()->ip() }}</span>
                </div>
                <div class="text-[9px] font-medium text-slate-400 dark:text-slate-500 text-center sm:text-right transition-colors duration-300 tracking-wide">
                    © 2026 BNN Kabupaten Malang • Sistem Informasi CUTi Elektronik
                </div>
            </div>

        </div>
    </div>
</body>
</html>
