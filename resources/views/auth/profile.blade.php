<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin - SI-CUTE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

    <!-- NAVBAR -->
    <nav class="bg-blue-800 shadow-md">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
            <div class="flex items-center gap-3 text-white">
                <a href="{{ route('dashboard') }}" class="hover:bg-blue-700 p-2 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <span class="font-bold text-lg tracking-wide">Pengaturan Profil & Keamanan</span>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-8">
        @if(session('success'))
        <div class="mb-6 bg-emerald-100 text-emerald-800 px-4 py-3 rounded-xl shadow-sm border border-emerald-200 flex items-center gap-2 font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="mb-6 bg-red-100 text-red-800 px-4 py-3 rounded-xl shadow-sm border border-red-200 flex items-center gap-2 font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            {{ session('error') }}
        </div>
        @endif
        @if($errors->any())
        <div class="mb-6 bg-amber-100 text-amber-800 px-4 py-3 rounded-xl shadow-sm border border-amber-200 font-medium">
            {{ $errors->first() }}
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- KOLOM KIRI -->
            <div class="space-y-6">
                <!-- INFO AKUN -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                    <h3 class="font-bold text-lg mb-4 flex items-center gap-2"><svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> Informasi Akun</h3>
                    <form action="{{ route('profil.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="action" value="update_profile">
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ $user->name }}" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                        </div>
                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Username Login</label>
                            <input type="text" name="username" value="{{ $user->username }}" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                        </div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-sm transition w-full md:w-auto">Simpan Perubahan Akun</button>
                    </form>
                </div>

                <!-- UBAH KATA SANDI -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                    <h3 class="font-bold text-lg mb-4 flex items-center gap-2"><svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg> Ubah Kata Sandi</h3>
                    <form action="{{ route('profil.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="action" value="update_password">
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-red-600 mb-1">Kata Sandi Lama (Verifikasi)</label>
                            <input type="password" name="old_password" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none bg-red-50">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Kata Sandi Baru</label>
                                <input type="password" name="new_password" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Ulangi Sandi Baru</label>
                                <input type="password" name="new_password_confirmation" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                            </div>
                        </div>
                        <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-sm transition w-full md:w-auto">Update Kata Sandi</button>
                    </form>
                </div>
            </div>

            <!-- KOLOM KANAN (AREA PIN) -->
            <div class="space-y-6">
                <!-- PIN ATUR HAK CUTI -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 border-t-4 border-t-purple-500 relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 opacity-5 pointer-events-none"><svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C9.243 2 7 4.243 7 7v3H6a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2v-8a2 2 0 00-2-2h-1V7c0-2.757-2.243-5-5-5z"></path></svg></div>
                    <h3 class="font-bold text-lg mb-1 text-purple-700 flex items-center gap-2">🔒 PIN Atur Hak Cuti</h3>
                    <p class="text-xs text-slate-500 mb-5 relative z-10">Gunakan untuk otorisasi saat menyimpan pengaturan sisa cuti pegawai.</p>
                    <form action="{{ route('profil.update') }}" method="POST" class="relative z-10">
                        @csrf
                        <input type="hidden" name="action" value="update_pin_cuti">
                        <div class="mb-4">
                            <label class="block text-xs font-bold text-red-600 mb-1">Verifikasi Kata Sandi Akun</label>
                            <input type="password" name="password_verify" required class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none bg-red-50">
                        </div>
                        <div class="grid grid-cols-2 gap-4 mb-5">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">PIN 6-Digit Baru</label>
                                <input type="password" name="pin_cuti" maxlength="6" required class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none tracking-widest text-center font-mono text-lg" placeholder="••••••">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Ulangi PIN Cuti</label>
                                <input type="password" name="pin_cuti_confirmation" maxlength="6" required class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none tracking-widest text-center font-mono text-lg" placeholder="••••••">
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-sm transition">Simpan PIN Hak Cuti</button>
                    </form>
                </div>

                <!-- PIN HAPUS PEGAWAI -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 border-t-4 border-t-rose-500 relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 opacity-5 pointer-events-none"><svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M6 7H5v13a2 2 0 002 2h10a2 2 0 002-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path></svg></div>
                    <h3 class="font-bold text-lg mb-1 text-rose-600 flex items-center gap-2">🛡️ PIN Hapus Pegawai</h3>
                    <p class="text-xs text-slate-500 mb-5 relative z-10">Otorisasi khusus untuk menghapus data pegawai secara permanen.</p>
                    <form action="{{ route('profil.update') }}" method="POST" class="relative z-10">
                        @csrf
                        <input type="hidden" name="action" value="update_pin_hapus">
                        <div class="mb-4">
                            <label class="block text-xs font-bold text-red-600 mb-1">Verifikasi Kata Sandi Akun</label>
                            <input type="password" name="password_verify" required class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:ring-2 focus:ring-rose-500 outline-none bg-red-50">
                        </div>
                        <div class="grid grid-cols-2 gap-4 mb-5">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">PIN 6-Digit Baru</label>
                                <input type="password" name="pin_hapus" maxlength="6" required class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:ring-2 focus:ring-rose-500 outline-none tracking-widest text-center font-mono text-lg" placeholder="••••••">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Ulangi PIN Hapus</label>
                                <input type="password" name="pin_hapus_confirmation" maxlength="6" required class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:ring-2 focus:ring-rose-500 outline-none tracking-widest text-center font-mono text-lg" placeholder="••••••">
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-sm transition">Simpan PIN Hapus</button>
                    </form>
                </div>
            </div>

        </div>
    </main>
</body>
</html>