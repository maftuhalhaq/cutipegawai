<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SI-CUTE - Dashboard Cuti BNNK Malang</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SWEETALERT2 & FLATPICKR -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>

    <!-- Custom UI Animations & Styles -->
    <style>
        body { font-family: 'figtree', sans-serif; }

        .animate-fade-in-up { animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .animation-delay-100 { animation-delay: 100ms; }
        .animation-delay-200 { animation-delay: 200ms; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Modal Transitions */
        .modal { transition: opacity 0.3s ease-in-out; }

        /* Radio Card Styles */
        .radio-card-input:checked + .radio-card-body { border-color: #3b82f6; background-color: #eff6ff; color: #1e3a8a; }
        .radio-card-input:checked + .radio-card-body .radio-circle { border-color: #3b82f6; background-color: #3b82f6; box-shadow: inset 0 0 0 3px #eff6ff; }
        .dark .radio-card-input:checked + .radio-card-body { border-color: #3b82f6; background-color: rgba(59, 130, 246, 0.15); color: #bfdbfe; }
        .dark .radio-card-input:checked + .radio-card-body .radio-circle { border-color: #60a5fa; background-color: #3b82f6; box-shadow: inset 0 0 0 3px #0f172a; }

        /* Formal Table within Modals */
        .table-formal { width: 100%; border-collapse: collapse; }
        .table-formal th, .table-formal td { border: 1px solid #cbd5e1; padding: 0.75rem 1rem; vertical-align: middle; }
        .dark .table-formal th, .dark .table-formal td { border-color: #334155; }

        /* SweetAlert2 Modern Styling */
        .swal2-popup { font-family: 'figtree', sans-serif !important; border-radius: 1.5rem !important; }
        .swal2-title { font-weight: 800 !important; font-size: 1.5rem !important; }
        .swal2-confirm, .swal2-cancel { border-radius: 0.75rem !important; font-weight: 700 !important; font-size: 0.875rem !important; padding: 0.75rem 1.5rem !important; transition: all 0.2s !important; }
        .swal2-confirm:active, .swal2-cancel:active { transform: scale(0.95); }
        .dark .swal2-popup { background-color: #0f172a !important; color: #f8fafc !important; border: 1px solid #1e293b !important; }
        .dark .swal2-title { color: #f8fafc !important; }
        .dark .swal2-html-container { color: #94a3b8 !important; }
        .dark .swal2-input { background-color: #1e293b !important; border-color: #334155 !important; color: #f8fafc !important; }

        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar { height: 6px; width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 20px; }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #334155; }
    </style>
</head>
<body class="bg-slate-100/80 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased relative selection:bg-blue-600 selection:text-white flex items-center justify-center min-h-screen py-8 px-4 sm:px-8 transition-colors duration-300">

    <!-- Jendela Aplikasi Mac UI -->
    <div class="w-full max-w-[1400px] bg-white dark:bg-slate-900 rounded-[1.5rem] shadow-2xl dark:shadow-[0_20px_50px_rgba(0,0,0,0.6)] overflow-hidden flex flex-col border border-slate-300 dark:border-slate-800 animate-fade-in-up opacity-0">

        <!-- Mac Window Top Bar (Level 1) -->
        <div class="bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800/60 px-5 py-3 flex items-center justify-between">
            <div class="flex items-center space-x-6">
                <!-- Traffic Lights dengan gap-1.5 agar presisi -->
                <div class="flex items-center gap-1.5">
                    <div class="w-3.5 h-3.5 rounded-full bg-red-500 shadow-inner"></div>
                    <div class="w-3.5 h-3.5 rounded-full bg-yellow-400 shadow-inner"></div>
                    <div class="w-3.5 h-3.5 rounded-full bg-green-500 shadow-inner"></div>
                </div>
                <!-- Breadcrumb -->
                <div class="flex items-center text-xs font-bold text-slate-500 dark:text-slate-400">
                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Portal Cuti <span class="mx-2 text-slate-300 dark:text-slate-600">/</span> <span class="text-slate-800 dark:text-slate-200">Kelola Data Pegawai & Cuti</span>
                </div>
            </div>
            <!-- Top Right Branding -->
            <div class="text-[10px] font-bold text-slate-500 dark:text-slate-400 tracking-wide border border-slate-200 dark:border-slate-700/80 rounded-md px-3 py-1 flex items-center bg-slate-50 dark:bg-slate-800/50">
                <span class="text-slate-700 dark:text-slate-200">SI-CUTE</span> <span class="mx-1.5 font-normal text-slate-300 dark:text-slate-600">|</span> BNN Kab. Malang
            </div>
        </div>

        <!-- Sub Header (Level 2) -->
        <div class="bg-slate-50/50 dark:bg-slate-800/30 border-b border-slate-100 dark:border-slate-800/60 px-5 py-2.5 flex items-center justify-between text-[11px] font-medium text-slate-500 dark:text-slate-400">
            <!-- Left Info -->
            <div class="flex items-center space-x-3">
                <span class="text-blue-600 dark:text-blue-400 font-semibold">Tahun Aktif: {{ $tahunBerjalan }}</span>
                <span class="text-slate-300 dark:text-slate-600">•</span>
                <span id="realtime-clock">Memuat waktu...</span>
                <span class="text-slate-300 dark:text-slate-600">•</span>
                <a href="{{ route('profil') }}" class="flex items-center text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 transition-colors group">
                    <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5 animate-pulse"></div>
                    Admin Kepegawaian
                </a>
            </div>
            <!-- Right Profile & Logout -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('profil') }}" class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-[10px] shadow-sm hover:scale-105 transition-transform" title="Profil">
                    {{ substr($user->name ?? 'A', 0, 1) }}
                </a>
                <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                    @csrf
                    <button type="submit" class="p-1 rounded text-slate-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-colors" title="Keluar">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </div>

        <!-- Dashboard Content Area -->
        <div class="flex-1 bg-white dark:bg-slate-900 p-8 overflow-y-auto">

            <!-- Alerts -->
            @if(session('success'))
            <div class="mb-6 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm text-sm animate-fade-in-up">
                <div class="bg-emerald-500 text-white rounded-full p-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></div>
                <div><span class="font-bold">Berhasil!</span> {{ session('success') }}</div>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 bg-rose-50 dark:bg-rose-500/10 border border-rose-100 dark:border-rose-500/20 text-rose-700 dark:text-rose-400 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm text-sm animate-fade-in-up">
                <div class="bg-rose-500 text-white rounded-full p-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg></div>
                <div><span class="font-bold">Gagal!</span> {{ session('error') }}</div>
            </div>
            @endif

            <!-- Content Header -->
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end mb-6 opacity-0 animate-fade-in-up animation-delay-100">
                <div class="mb-4 lg:mb-0">
                    <h1 class="text-2xl font-extrabold text-slate-800 dark:text-white tracking-tight mb-1">Data Pegawai & Cuti</h1>
                    <p class="text-slate-500 dark:text-slate-400 text-xs font-medium">Kelola data pegawai, tinjau sisa cuti, dan catat riwayat pengajuan cuti baru.</p>
                </div>

                <div class="flex items-center gap-3 w-full lg:w-auto">
                    <div class="relative w-full sm:w-64 group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-300 dark:text-slate-500 group-focus-within:text-blue-500 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" id="searchPegawai" oninput="filterPegawai()" autocomplete="off" role="presentation" class="w-full pl-9 pr-4 py-2 border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 rounded-lg focus:bg-white dark:focus:bg-slate-800 focus:ring-2 focus:ring-blue-600/20 focus:border-blue-500 dark:focus:border-blue-500 outline-none text-xs font-medium text-slate-700 dark:text-slate-200 shadow-sm transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600" placeholder="Cari nama / jabatan...">
                    </div>
                    <button onclick="openModal('modalTambahPegawai')" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-xs font-bold shadow-sm transition-colors flex items-center justify-center gap-1.5 shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Pegawai
                    </button>
                </div>
            </div>

            <!-- Data Table Container -->
            <div class="border border-slate-100 dark:border-slate-800 rounded-xl overflow-hidden mb-4 opacity-0 animate-fade-in-up animation-delay-200 transition-colors duration-300">
                <div class="overflow-x-auto custom-scrollbar">
                    <table class="min-w-full text-left border-collapse">
                        <thead class="bg-slate-50 dark:bg-slate-800/40 border-b border-slate-100 dark:border-slate-800">
                            <tr>
                                <th class="px-5 py-3 text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-10 text-center">No</th>
                                <th class="px-5 py-3 text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Informasi Pegawai</th>
                                <th class="px-5 py-3 text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-center">Golongan</th>
                                <th class="px-5 py-3 text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-center">Status</th>
                                <th class="px-5 py-3 text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-center">Sisa Cuti</th>
                                <th class="px-5 py-3 text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-center">Aksi Kelola</th>
                            </tr>
                        </thead>
                        <tbody id="tabelPegawai" class="divide-y divide-slate-50 dark:divide-slate-800/60 bg-white dark:bg-slate-900 transition-colors duration-300">
                            @foreach($employees as $index => $emp)

                            @php
                                $bN = $emp->leaveBalances()->where('tahun', $tahunBerjalan)->first();
                                $bN1 = $emp->leaveBalances()->where('tahun', $tahunBerjalan - 1)->first();
                                $bN2 = $emp->leaveBalances()->where('tahun', $tahunBerjalan - 2)->first();

                                $valN = $bN ? $bN->sisa_cuti_total : 12;
                                $valN1 = $bN1 ? $bN1->sisa_cuti_total : 0;
                                $valN2 = $bN2 ? $bN2->sisa_cuti_total : 0;

                                $hakDasarN = $bN ? $bN->hak_cuti_dasar : 12;

                                $sisaHari = $valN + min($valN1, 6) + min($valN2, 6);
                            @endphp

                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition-colors group">
                                <td class="px-5 py-3.5 text-[11px] font-medium text-slate-400 dark:text-slate-500 text-center">{{ $index + 1 }}</td>
                                <td class="px-5 py-3.5">
                                    <div class="text-[11px] font-extrabold text-slate-800 dark:text-slate-100 uppercase">{{ $emp->nama }}</div>
                                    <div class="text-[10px] font-medium text-slate-400 dark:text-slate-500 mt-0.5 uppercase">{{ $emp->jabatan ?? '-' }}</div>
                                </td>
                                <td class="px-5 py-3.5 text-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-slate-50 dark:bg-slate-800 text-slate-500 dark:text-slate-400 border border-slate-100 dark:border-slate-700">
                                        {{ $emp->golongan ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 text-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold
                                        @if($emp->status == 'PNS') bg-emerald-50 text-emerald-600 border-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400 dark:border-emerald-500/20
                                        @elseif($emp->status == 'TNI') bg-blue-50 text-blue-600 border-blue-100 dark:bg-blue-500/10 dark:text-blue-400 dark:border-blue-500/20
                                        @elseif($emp->status == 'POLRI') bg-slate-100 text-slate-600 border-slate-200 dark:bg-blue-500/10 dark:text-blue-400 dark:border-blue-500/20
                                        @elseif(str_contains($emp->status, 'PPPK PARUH WAKTU')) bg-amber-50 text-amber-600 border-amber-100 dark:bg-amber-500/10 dark:text-amber-400 dark:border-amber-500/20
                                        @elseif(str_contains($emp->status, 'PPPK')) bg-teal-50 text-teal-600 border-teal-100 dark:bg-teal-500/10 dark:text-teal-400 dark:border-teal-500/20
                                        @else bg-emerald-50 text-emerald-500 border-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400 dark:border-emerald-500/20 @endif
                                        uppercase tracking-wider border">
                                        {{ str_replace('_', ' ', $emp->status) }}
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 text-center">
                                    <div class="text-xs font-bold text-blue-600 dark:text-blue-400">
                                        {{ $sisaHari }} <span class="text-[10px] font-medium text-slate-400 dark:text-slate-500 ml-0.5">Hari</span>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5 text-center">
                                    <div class="flex items-center justify-center gap-1.5 flex-wrap">
                                        <button onclick="openModalAturCuti({{ $emp->id }}, '{{ addslashes($emp->nama) }}', '{{ $emp->status }}', {{ $hakDasarN }}, {{ $valN1 }}, {{ $valN2 }})" class="px-2.5 py-1 bg-white dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 hover:bg-purple-50 dark:hover:bg-purple-500/20 border border-purple-200 dark:border-purple-500/30 text-[10px] font-bold rounded shadow-sm transition-colors">
                                            Atur Hak Cuti
                                        </button>
                                        <button onclick="openModalInputCuti({{ $emp->id }}, '{{ addslashes($emp->nama) }}', '{{ $emp->status }}', {{ $sisaHari }}, {{ $valN }}, {{ min($valN1, 6) }}, {{ min($valN2, 6) }}, {{ $hakDasarN }})" class="px-2.5 py-1 bg-white dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-500/20 border border-emerald-200 dark:border-emerald-500/30 text-[10px] font-bold rounded shadow-sm transition-colors">
                                            + Input
                                        </button>
                                        <button onclick="openModal('modalProfil_{{ $emp->id }}')" class="px-2.5 py-1 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-600 text-[10px] font-bold rounded shadow-sm transition-colors">
                                            Edit Profil
                                        </button>
                                        <button onclick="openModal('modalDetailCuti_{{ $emp->id }}')" class="px-2.5 py-1 bg-white dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-500/20 border border-blue-200 dark:border-blue-500/30 text-[10px] font-bold rounded shadow-sm transition-colors">
                                            Detail Cuti
                                        </button>
                                        <form action="{{ route('pegawai.destroy', $emp->id) }}" method="POST" class="m-0 p-0 inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="konfirmasiHapusPegawai(this, '{{ addslashes($emp->nama) }}')" class="px-2.5 py-1 bg-white dark:bg-rose-500/10 text-rose-500 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-500/20 border border-rose-200 dark:border-rose-500/30 text-[10px] font-bold rounded shadow-sm transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            <!-- Footer -->
            <div class="flex flex-col sm:flex-row justify-between items-center text-[10px] text-slate-400 dark:text-slate-500 opacity-0 animate-fade-in-up animation-delay-200 mt-2 px-2">
                <div class="flex items-center space-x-2 mb-4 sm:mb-0">
                    <div class="w-1.5 h-1.5 rounded-full bg-blue-500"></div>
                    <span>Terakhir diperbarui: {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB</span>
                    <span class="mx-1">•</span>
                    <span>Sinkronisasi Database BNNK Malang Aktif</span>
                </div>
                <div class="font-medium">v2.4.8 (macOS Soft-UI Dark)</div>
            </div>

        </div>
    </div>

    <!-- =========================================================================== -->
    <!-- LOOPING MODAL (DI LUAR TABEL)                                               -->
    <!-- =========================================================================== -->
    @foreach($employees as $emp)
        @php
            $bN = $emp->leaveBalances()->where('tahun', $tahunBerjalan)->first();
            $bN1 = $emp->leaveBalances()->where('tahun', $tahunBerjalan - 1)->first();
            $bN2 = $emp->leaveBalances()->where('tahun', $tahunBerjalan - 2)->first();

            $valN = $bN ? $bN->sisa_cuti_total : 12;
            $valN1 = $bN1 ? $bN1->sisa_cuti_total : 0;
            $valN2 = $bN2 ? $bN2->sisa_cuti_total : 0;

            $hakDasarN = $bN ? $bN->hak_cuti_dasar : 12;
            $hakDasarN1 = $bN1 ? $bN1->hak_cuti_dasar : 0;
            $hakDasarN2 = $bN2 ? $bN2->hak_cuti_dasar : 0;

            $sisaHari = $valN + min($valN1, 6) + min($valN2, 6);
            $riwayatCuti = $emp->leaveHistories()->where('tahun', $tahunBerjalan)->orderBy('created_at', 'desc')->get();
        @endphp

        <!-- MODAL EDIT PROFIL -->
        <div id="modalProfil_{{ $emp->id }}" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
            <div class="modal-overlay absolute w-full h-full bg-slate-900/40 dark:bg-slate-900/80 backdrop-blur-[2px] transition-opacity"></div>
            <div class="modal-container bg-white dark:bg-[#111827] w-11/12 md:max-w-2xl mx-auto rounded-3xl shadow-[0_20px_60px_-15px_rgba(0,0,0,0.3)] dark:shadow-none border border-white/20 dark:border-slate-800 z-50 overflow-y-auto max-h-[90vh] transition-all transform scale-95 duration-300">
                <form action="{{ route('pegawai.update', $emp->id) }}" method="POST" class="p-0">
                    @csrf
                    @method('PUT')
                    <div class="px-7 py-5 flex justify-between items-center bg-transparent">
                        <h2 class="text-xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">Profil & Edit Pegawai</h2>
                        <button type="button" onclick="closeModal('modalProfil_{{ $emp->id }}')" class="text-slate-400 hover:text-rose-500 dark:text-slate-500 dark:hover:text-rose-400 transition-colors p-2 rounded-full hover:bg-slate-50 dark:hover:bg-slate-800/50">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    <div class="px-7 py-2 space-y-5 text-sm bg-white dark:bg-[#111827]">
                        <div class="grid grid-cols-2 gap-5">
                            <div class="col-span-2">
                                <label class="block font-bold text-slate-700 dark:text-slate-200 mb-1.5 text-xs">Nama Lengkap <span class="text-rose-500">*</span></label>
                                <input type="text" name="nama" value="{{ $emp->nama }}" required class="w-full px-4 py-2.5 bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-4 focus:ring-blue-500/10 dark:focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 dark:text-slate-200 outline-none transition-all text-sm shadow-sm">
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 dark:text-slate-200 mb-1.5 text-xs">NIP / NRP / NI PPPK</label>
                                <input type="text" name="nip_nrp" value="{{ $emp->nip_nrp }}" class="w-full px-4 py-2.5 bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-4 focus:ring-blue-500/10 dark:focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 dark:text-slate-200 outline-none transition-all text-sm shadow-sm">
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 dark:text-slate-200 mb-1.5 text-xs">Status Kepegawaian <span class="text-rose-500">*</span></label>
                                <select name="status" required class="w-full px-4 py-2.5 bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-4 focus:ring-blue-500/10 dark:focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 dark:text-slate-200 outline-none transition-all text-sm appearance-none shadow-sm font-semibold">
                                    <option value="PNS" {{ $emp->status == 'PNS' ? 'selected' : '' }}>PNS</option>
                                    <option value="PPPK" {{ $emp->status == 'PPPK' ? 'selected' : '' }}>PPPK</option>
                                    <option value="TNI" {{ $emp->status == 'TNI' ? 'selected' : '' }}>TNI</option>
                                    <option value="POLRI" {{ $emp->status == 'POLRI' ? 'selected' : '' }}>POLRI</option>
                                    <option value="PPPK_PARUH_WAKTU" {{ $emp->status == 'PPPK_PARUH_WAKTU' ? 'selected' : '' }}>PPPK PARUH WAKTU</option>
                                    <option value="OUTSOURCING" {{ $emp->status == 'OUTSOURCING' ? 'selected' : '' }}>OUTSOURCING</option>
                                </select>
                            </div>
                            <div class="col-span-2">
                                <label class="block font-bold text-slate-700 dark:text-slate-200 mb-1.5 text-xs">Jabatan</label>
                                <input type="text" name="jabatan" value="{{ $emp->jabatan }}" class="w-full px-4 py-2.5 bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-4 focus:ring-blue-500/10 dark:focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 dark:text-slate-200 outline-none transition-all text-sm shadow-sm">
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 dark:text-slate-200 mb-1.5 text-xs">Pangkat</label>
                                <input type="text" name="pangkat" value="{{ $emp->pangkat }}" class="w-full px-4 py-2.5 bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-4 focus:ring-blue-500/10 dark:focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 dark:text-slate-200 outline-none transition-all text-sm shadow-sm">
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 dark:text-slate-200 mb-1.5 text-xs">Golongan</label>
                                <input type="text" name="golongan" value="{{ $emp->golongan }}" class="w-full px-4 py-2.5 bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-4 focus:ring-blue-500/10 dark:focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 dark:text-slate-200 outline-none transition-all text-sm shadow-sm">
                            </div>
                        </div>
                    </div>
                    <div class="px-7 py-6 bg-transparent flex justify-end gap-3 rounded-b-3xl mt-1">
                        <button type="button" onclick="closeModal('modalProfil_{{ $emp->id }}')" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800/80 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 rounded-xl text-[13px] font-bold transition-colors">Batal</button>
                        <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-[13px] font-bold transition-all active:scale-95 shadow-md shadow-blue-500/20 dark:shadow-none">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL DETAIL CUTI & RIWAYAT -->
        <div id="modalDetailCuti_{{ $emp->id }}" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
            <div class="modal-overlay absolute w-full h-full bg-slate-900/40 dark:bg-slate-900/80 backdrop-blur-[2px] transition-opacity"></div>
            <div class="modal-container bg-white dark:bg-[#111827] w-11/12 md:max-w-4xl mx-auto rounded-3xl shadow-[0_20px_60px_-15px_rgba(0,0,0,0.3)] dark:shadow-none border border-white/20 dark:border-slate-800 z-50 overflow-y-auto max-h-[90vh] transition-all transform scale-95 duration-300">

                <!-- Modal Header -->
                <div class="px-7 py-5 border-b border-slate-100 dark:border-slate-800/80 flex justify-between items-start bg-transparent">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">Detail Data Cuti Pegawai</h2>
                        <div class="flex items-center gap-2 mt-2 flex-wrap">
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-200 uppercase">{{ $emp->nama }}</span>
                            <span class="px-2 py-0.5 rounded-md bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 border border-blue-100 dark:border-blue-800/50 text-[10px] font-bold">
                                {{ $emp->status }} • {{ $emp->pangkat ?? '-' }} ({{ $emp->golongan ?? '-' }})
                            </span>
                            <span class="px-2 py-0.5 rounded-md bg-slate-50 dark:bg-slate-800/80 text-slate-500 dark:text-slate-400 border border-slate-200 dark:border-slate-700 text-[10px] font-medium tracking-wide">
                                NIP: {{ $emp->nip_nrp ?? '-' }}
                            </span>
                        </div>
                    </div>
                    <button onclick="closeModal('modalDetailCuti_{{ $emp->id }}')" class="text-slate-400 hover:text-rose-500 dark:text-slate-500 dark:hover:text-rose-400 transition-colors p-2 rounded-full hover:bg-slate-50 dark:hover:bg-slate-800/50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="px-7 py-6 space-y-7 bg-white dark:bg-[#111827]">

                    <!-- Section V: SISA HAK CUTI -->
                    <div>
                        <div class="flex justify-between items-end mb-3">
                            <h3 class="font-bold text-slate-800 dark:text-slate-200 text-[11px] uppercase tracking-wider flex items-center gap-2">
                                <div class="w-1 h-3.5 bg-blue-500 rounded-full"></div> V. Sisa Hak Cuti (Multi-Tahun)
                            </h3>
                            <span class="text-[9px] text-slate-400 dark:text-slate-500 font-medium">Berdasarkan Perka BKN No. 24/2017</span>
                        </div>
                        <div class="border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden shadow-sm">
                            <table class="table-formal text-[10px] w-full bg-white dark:bg-transparent">
                                <thead class="bg-slate-50/50 dark:bg-slate-800/30 font-bold uppercase text-center text-slate-500 dark:text-slate-400">
                                    <tr>
                                        <th rowspan="2" class="py-2.5 border-r border-b border-slate-200 dark:border-slate-800">Tahun</th>
                                        <th colspan="2" class="py-2.5 border-r border-b border-slate-200 dark:border-slate-800">Sisa</th>
                                        <th rowspan="2" class="py-2.5 border-b border-slate-200 dark:border-slate-800">Keterangan</th>
                                    </tr>
                                    <tr>
                                        <th class="py-2 border-r border-b border-slate-200 dark:border-slate-800">Semula</th>
                                        <th class="py-2 border-r border-b border-slate-200 dark:border-slate-800">Menjadi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center font-bold text-xs text-slate-700 dark:text-slate-300 divide-y divide-slate-200 dark:divide-slate-800">
                                    @php
                                        $lastCutiTahunan = $emp->leaveHistories()->where('tahun', $tahunBerjalan)->where('jenis_cuti', 'Cuti Tahunan')->orderBy('created_at', 'desc')->first();
                                        $durasiTerakhir = $lastCutiTahunan ? $lastCutiTahunan->durasi : 0;

                                        $semulaN2 = $valN2; $semulaN1 = $valN1; $semulaN = $valN; $tempDurasi = $durasiTerakhir;

                                        if ($tempDurasi > 0 && $valN < $hakDasarN) { $spaceN = $hakDasarN - $valN; $addBackN = min($spaceN, $tempDurasi); $semulaN += $addBackN; $tempDurasi -= $addBackN; }
                                        if ($tempDurasi > 0 && $valN1 < $hakDasarN1) { $spaceN1 = $hakDasarN1 - $valN1; $addBackN1 = min($spaceN1, $tempDurasi); $semulaN1 += $addBackN1; $tempDurasi -= $addBackN1; }
                                        if ($tempDurasi > 0 && $valN2 < $hakDasarN2) { $spaceN2 = $hakDasarN2 - $valN2; $addBackN2 = min($spaceN2, $tempDurasi); $semulaN2 += $addBackN2; }
                                    @endphp

                                    @if($emp->status != 'PPPK_PARUH_WAKTU' && $emp->status != 'OUTSOURCING')
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors">
                                        <td class="py-3.5 text-[11px] text-slate-600 dark:text-slate-400 border-r border-slate-200 dark:border-slate-800">N-2 ({{ $tahunBerjalan - 2 }})</td>
                                        <td class="border-r border-slate-200 dark:border-slate-800">{{ $semulaN2 }}</td>
                                        <td class="border-r border-slate-200 dark:border-slate-800">{{ $valN2 }}</td>
                                        <td class="font-medium text-[11px] text-slate-500 dark:text-slate-400">{{ $tahunBerjalan - 2 }}</td>
                                    </tr>
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors">
                                        <td class="py-3.5 text-[11px] text-slate-600 dark:text-slate-400 border-r border-slate-200 dark:border-slate-800">N-1 ({{ $tahunBerjalan - 1 }})</td>
                                        <td class="border-r border-slate-200 dark:border-slate-800">{{ $semulaN1 }}</td>
                                        <td class="border-r border-slate-200 dark:border-slate-800">{{ $valN1 }}</td>
                                        <td class="font-medium text-[11px] text-slate-500 dark:text-slate-400">{{ $tahunBerjalan - 1 }}</td>
                                    </tr>
                                    @endif
                                    <tr class="bg-blue-50/20 dark:bg-blue-900/10">
                                        <td class="py-3.5 text-[11px] border-r border-slate-200 dark:border-slate-800">N ({{ $tahunBerjalan }})</td>
                                        <td class="border-r border-slate-200 dark:border-slate-800">{{ $semulaN }}</td>
                                        <td class="text-blue-600 dark:text-blue-400 text-sm border-r border-slate-200 dark:border-slate-800">{{ $valN }}</td>
                                        <td class="font-bold text-[11px] text-slate-600 dark:text-slate-300 flex items-center justify-center gap-1.5 h-full py-3.5">
                                            {{ $tahunBerjalan }} (Berjalan) <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Section VI: RIWAYAT PENGAJUAN -->
                    <div>
                        <div class="flex justify-between items-end mb-3">
                            <h3 class="font-bold text-slate-800 dark:text-slate-200 text-[11px] uppercase tracking-wider flex items-center gap-2">
                                <div class="w-1 h-3.5 bg-blue-500 rounded-full"></div> VI. Riwayat Pengajuan Cuti (Tahun {{ $tahunBerjalan }})
                            </h3>
                            <span class="text-[9px] text-slate-400 dark:text-slate-500 font-medium">Total Pengajuan: {{ count($riwayatCuti) }} Kali</span>
                        </div>
                        <div class="border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden shadow-sm">
                            <table class="w-full text-xs text-left divide-y divide-slate-200 dark:divide-slate-800 bg-white dark:bg-transparent">
                                <thead class="bg-slate-50/50 dark:bg-slate-800/30 text-[9px] text-slate-500 dark:text-slate-400 uppercase tracking-wider text-center font-bold">
                                    <tr>
                                        <th class="px-3 py-3 border-r border-slate-200 dark:border-slate-800">Waktu Input</th>
                                        <th class="px-3 py-3 border-r border-slate-200 dark:border-slate-800">Jenis Cuti</th>
                                        <th class="px-3 py-3 border-r border-slate-200 dark:border-slate-800 w-1/4">Alasan Cuti</th>
                                        <th class="px-3 py-3 border-r border-slate-200 dark:border-slate-800">Mulai Tanggal</th>
                                        <th class="px-3 py-3 border-r border-slate-200 dark:border-slate-800">Sampai Dengan</th>
                                        <th class="px-3 py-3 border-r border-slate-200 dark:border-slate-800">Durasi</th>
                                        <th class="px-2 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60">
                                    @forelse($riwayatCuti as $riwayat)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors text-center group">
                                        <td class="px-3 py-2.5 border-r border-slate-100 dark:border-slate-800/60 whitespace-nowrap">
                                            <div class="text-[10px] text-slate-400 dark:text-slate-500">{{ \Carbon\Carbon::parse($riwayat->created_at)->timezone('Asia/Jakarta')->format('d M y') }}</div>
                                            <div class="font-bold text-slate-600 dark:text-slate-300">{{ \Carbon\Carbon::parse($riwayat->created_at)->timezone('Asia/Jakarta')->format('H:i') }} WIB</div>
                                        </td>
                                        <td class="px-3 py-2.5 border-r border-slate-100 dark:border-slate-800/60">
                                            <span class="text-[10px] font-bold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded border border-slate-200 dark:border-slate-700">{{ $riwayat->jenis_cuti }}</span>
                                        </td>
                                        <td class="px-3 py-2.5 border-r border-slate-100 dark:border-slate-800/60 text-left text-slate-500 dark:text-slate-400 font-medium text-[11px] leading-relaxed">{{ $riwayat->alasan }}</td>
                                        <td class="px-3 py-2.5 border-r border-slate-100 dark:border-slate-800/60 font-semibold text-slate-700 dark:text-slate-300 text-[11px]">{{ \Carbon\Carbon::parse($riwayat->mulai_tanggal)->format('d M Y') }}</td>
                                        <td class="px-3 py-2.5 border-r border-slate-100 dark:border-slate-800/60 font-semibold text-slate-700 dark:text-slate-300 text-[11px]">{{ \Carbon\Carbon::parse($riwayat->sampai_tanggal)->format('d M Y') }}</td>
                                        <td class="px-3 py-2.5 font-bold text-blue-600 dark:text-blue-400 border-r border-slate-100 dark:border-slate-800/60">{{ $riwayat->durasi }} Hari</td>
                                        <td class="px-2 py-2.5">
                                            <form action="{{ route('cuti.destroy', $riwayat->id) }}" method="POST" class="m-0 p-0 inline-block">
                                                @csrf @method('DELETE')
                                                <button type="button" onclick="konfirmasiBatalkanCuti(this, '{{ $riwayat->jenis_cuti }}')" class="text-rose-400 hover:text-rose-600 dark:hover:text-rose-300 p-1 transition-colors opacity-70 group-hover:opacity-100" title="Batalkan">
                                                    <svg class="w-4 h-4 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="bg-slate-50/30 dark:bg-[#0f172a]/30">
                                            <div class="flex flex-col items-center justify-center py-10 opacity-70">
                                                <div class="w-10 h-10 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-full flex items-center justify-center mb-3 shadow-sm">
                                                    <svg class="w-5 h-5 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                </div>
                                                <p class="text-xs font-bold text-slate-600 dark:text-slate-300">Belum ada riwayat pengajuan cuti yang tercatat.</p>
                                                <p class="text-[10px] font-medium text-slate-400 dark:text-slate-500 mt-1">Hak cuti tahunan tahun {{ $tahunBerjalan }} masih tersedia penuh ({{ $valN }} Hari).</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="px-7 py-4 bg-slate-50/50 dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800/80 flex justify-between items-center rounded-b-3xl mt-1">
                    <div class="flex items-center text-[9px] text-slate-400 dark:text-slate-500 font-medium space-x-1.5 hidden sm:flex">
                        <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
                        <span>Terakhir diperbarui: {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB</span>
                        <span>•</span>
                        <span>Sinkronisasi Database BNNK Malang</span>
                    </div>
                    <button onclick="closeModal('modalDetailCuti_{{ $emp->id }}')" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 rounded-xl text-[11px] font-bold shadow-sm transition-colors w-full sm:w-auto">
                        Tutup Detail
                    </button>
                </div>
            </div>
        </div>
    @endforeach

    <!-- MODAL GLOBAL: ATUR HAK CUTI -->
    <div id="modalAturCuti" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
        <div class="modal-overlay absolute w-full h-full bg-slate-900/40 dark:bg-slate-900/80 backdrop-blur-[2px] transition-opacity"></div>
        <div class="modal-container bg-white dark:bg-[#111827] w-11/12 md:max-w-md mx-auto rounded-3xl shadow-[0_20px_60px_-15px_rgba(0,0,0,0.3)] dark:shadow-none border border-white/20 dark:border-slate-800 z-50 overflow-y-auto transition-all transform scale-95 duration-300">
            <form id="formAturCuti" method="POST" class="p-0">
                @csrf
                <div class="px-7 py-5 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-transparent">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">Atur Hak Cuti</h2>
                        <p class="text-[10px] font-bold text-purple-600 dark:text-purple-400 mt-1 uppercase tracking-wider" id="atur_employee_name">Nama Pegawai</p>
                    </div>
                    <button type="button" onclick="closeModal('modalAturCuti')" class="text-slate-400 hover:text-rose-500 dark:text-slate-500 dark:hover:text-rose-400 transition-colors p-2 rounded-full hover:bg-slate-50 dark:hover:bg-slate-800/50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="px-7 py-6 space-y-5 text-sm bg-white dark:bg-[#111827]">
                    <div>
                        <label class="block font-bold text-slate-700 dark:text-slate-200 mb-1.5 text-xs">Hak Cuti Tahun {{ $tahunBerjalan }} (N - Berjalan)</label>
                        <input type="number" name="hak_cuti_n" id="input_cuti_n" min="0" max="12" required class="w-full px-4 py-2.5 bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl font-bold text-blue-600 dark:text-blue-400 focus:ring-4 focus:ring-purple-500/10 dark:focus:ring-purple-500/20 focus:border-purple-500 dark:focus:border-purple-500 outline-none shadow-sm transition-all text-sm">
                        <p class="text-[10px] text-amber-600 dark:text-amber-500 mt-2 font-medium flex items-center gap-1.5">
                            <span class="text-xs">⚠️</span> Maksimal hak cuti tahunan adalah 12 hari.
                        </p>
                    </div>

                    <div id="wrapper_cuti_n1">
                        <label class="block font-bold text-slate-700 dark:text-slate-200 mb-1.5 text-xs">Sisa Cuti Tahun {{ $tahunBerjalan - 1 }} (N-1)</label>
                        <input type="number" name="sisa_cuti_n1" id="input_sisa_n1" min="0" max="10" required class="w-full px-4 py-2.5 bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl font-bold text-purple-600 dark:text-purple-400 focus:ring-4 focus:ring-purple-500/10 dark:focus:ring-purple-500/20 focus:border-purple-500 dark:focus:border-purple-500 outline-none shadow-sm transition-all text-sm">
                        <p class="text-[10px] text-amber-600 dark:text-amber-500 mt-2 font-medium flex items-center gap-1.5">
                            <span class="text-xs">⚠️</span> Maksimal sisa dari tahun {{ $tahunBerjalan - 1 }} yang dihitung adalah 6 hari.
                        </p>
                    </div>

                    <div id="wrapper_cuti_n2">
                        <label class="block font-bold text-slate-700 dark:text-slate-200 mb-1.5 text-xs">Sisa Cuti Tahun {{ $tahunBerjalan - 2 }} (N-2)</label>
                        <input type="number" name="sisa_cuti_n2" id="input_sisa_n2" min="0" max="10" required class="w-full px-4 py-2.5 bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl font-bold text-emerald-600 dark:text-emerald-400 focus:ring-4 focus:ring-purple-500/10 dark:focus:ring-purple-500/20 focus:border-purple-500 dark:focus:border-purple-500 outline-none shadow-sm transition-all text-sm">
                        <p class="text-[10px] text-amber-600 dark:text-amber-500 mt-2 font-medium flex items-center gap-1.5">
                            <span class="text-xs">⚠️</span> Maksimal sisa dari tahun {{ $tahunBerjalan - 2 }} yang dihitung adalah 6 hari.
                        </p>
                    </div>

                    <!-- INPUT PIN OTORISASI UNTUK ATUR CUTI -->
                    <div class="pt-3">
                        <label class="block font-bold text-purple-600 dark:text-purple-400 mb-2 flex items-center gap-1.5 text-xs">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            PIN Otorisasi
                        </label>
                        <input type="password" name="pin" maxlength="6" autocomplete="new-password" required class="w-full px-4 py-3 bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-4 focus:ring-purple-500/10 dark:focus:ring-purple-500/20 focus:border-purple-500 dark:focus:border-purple-500 dark:text-slate-200 outline-none text-center tracking-[0.5em] font-mono text-lg shadow-sm transition-all placeholder:tracking-normal placeholder:text-sm placeholder:text-slate-400 dark:placeholder:text-slate-600" placeholder="••••••">
                        <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-2.5 text-center font-medium">Masukkan 6-Digit PIN Anda untuk menyimpan perubahan ini.</p>
                    </div>
                </div>

                <div class="px-7 py-5 bg-transparent flex justify-end gap-3 rounded-b-3xl mt-1">
                    <button type="button" onclick="closeModal('modalAturCuti')" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800/80 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 rounded-xl text-[13px] font-bold transition-colors">Batal</button>
                    <button type="submit" class="px-5 py-2.5 bg-purple-600 hover:bg-purple-700 text-white rounded-xl text-[13px] font-bold transition-all active:scale-95 shadow-md shadow-purple-500/20 dark:shadow-none">
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL GLOBAL: FORM INPUT CUTI -->
    <div id="modalInputCuti" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
        <div class="modal-overlay absolute w-full h-full bg-slate-900/40 dark:bg-slate-900/80 backdrop-blur-[2px] transition-opacity"></div>
        <div class="modal-container bg-white dark:bg-[#111827] w-11/12 md:max-w-4xl mx-auto rounded-3xl shadow-[0_20px_60px_-15px_rgba(0,0,0,0.3)] dark:shadow-none border border-white/20 dark:border-slate-800 z-50 overflow-y-auto max-h-[95vh] transition-all transform scale-95 duration-300">
            <form action="{{ route('cuti.store') }}" method="POST" class="p-0">
                @csrf
                <input type="hidden" name="employee_id" id="input_employee_id">

                <div class="px-7 py-5 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-transparent">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">Catat Pengajuan Cuti Baru</h2>
                        <p class="text-[11px] font-medium text-slate-400 dark:text-slate-500 mt-0.5">Isi formulir ini untuk mencatat riwayat dan mensimulasikan pemotongan hak cuti.</p>
                    </div>
                    <button type="button" onclick="closeModal('modalInputCuti')" class="text-slate-400 hover:text-rose-500 dark:text-slate-500 dark:hover:text-rose-400 transition-colors p-2 rounded-full hover:bg-slate-50 dark:hover:bg-slate-800/50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="px-7 py-6 space-y-6 bg-white dark:bg-[#111827]">

                    <!-- Employee Info Card -->
                    <div class="flex items-center gap-4 p-4 bg-blue-50/50 dark:bg-blue-900/10 border border-blue-100 dark:border-blue-900/30 rounded-2xl shadow-sm">
                        <div class="w-11 h-11 bg-white dark:bg-[#0f172a] text-blue-600 dark:text-blue-400 rounded-full flex items-center justify-center font-bold shadow-sm border border-blue-100 dark:border-slate-800">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800 dark:text-slate-100 tracking-wide" id="display_employee_name">Nama Pegawai</p>
                            <p class="text-[11px] font-medium text-slate-500 dark:text-slate-400 mt-0.5">Total Sisa Hak Cuti: <span class="font-bold text-blue-600 dark:text-blue-400 ml-0.5" id="display_sisa_cuti">12 Hari</span></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-5">
                            <div>
                                <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2.5">Jenis Cuti <span class="text-rose-500">*</span></label>
                                <div class="grid grid-cols-2 gap-3">
                                    <label class="cursor-pointer relative group">
                                        <input type="radio" name="jenis_cuti" value="Cuti Tahunan" class="radio-card-input sr-only" checked>
                                        <div class="radio-card-body flex items-center gap-2.5 p-3 border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-[#0f172a] rounded-xl transition-all shadow-sm text-slate-700 dark:text-slate-300">
                                            <div class="radio-circle w-3.5 h-3.5 rounded-full border-2 border-slate-300 dark:border-slate-600 flex-shrink-0 transition-all"></div><span class="text-[11px] font-bold">Cuti Tahunan</span>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer relative group">
                                        <input type="radio" name="jenis_cuti" value="Cuti Besar" class="radio-card-input sr-only">
                                        <div class="radio-card-body flex items-center gap-2.5 p-3 border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-[#0f172a] rounded-xl transition-all shadow-sm text-slate-700 dark:text-slate-300">
                                            <div class="radio-circle w-3.5 h-3.5 rounded-full border-2 border-slate-300 dark:border-slate-600 flex-shrink-0 transition-all"></div><span class="text-[11px] font-bold">Cuti Besar</span>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer relative group">
                                        <input type="radio" name="jenis_cuti" value="Cuti Sakit" class="radio-card-input sr-only">
                                        <div class="radio-card-body flex items-center gap-2.5 p-3 border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-[#0f172a] rounded-xl transition-all shadow-sm text-slate-700 dark:text-slate-300">
                                            <div class="radio-circle w-3.5 h-3.5 rounded-full border-2 border-slate-300 dark:border-slate-600 flex-shrink-0 transition-all"></div><span class="text-[11px] font-bold">Cuti Sakit</span>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer relative group">
                                        <input type="radio" name="jenis_cuti" value="Cuti Melahirkan" class="radio-card-input sr-only">
                                        <div class="radio-card-body flex items-center gap-2.5 p-3 border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-[#0f172a] rounded-xl transition-all shadow-sm text-slate-700 dark:text-slate-300">
                                            <div class="radio-circle w-3.5 h-3.5 rounded-full border-2 border-slate-300 dark:border-slate-600 flex-shrink-0 transition-all"></div><span class="text-[11px] font-bold">Cuti Melahirkan</span>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer relative group">
                                        <input type="radio" name="jenis_cuti" value="Alasan Penting" class="radio-card-input sr-only">
                                        <div class="radio-card-body flex items-center gap-2.5 p-3 border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-[#0f172a] rounded-xl transition-all shadow-sm text-slate-700 dark:text-slate-300">
                                            <div class="radio-circle w-3.5 h-3.5 rounded-full border-2 border-slate-300 dark:border-slate-600 flex-shrink-0 transition-all"></div><span class="text-[11px] font-bold">Alasan Penting</span>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer relative group">
                                        <input type="radio" name="jenis_cuti" value="Luar Tanggungan" class="radio-card-input sr-only">
                                        <div class="radio-card-body flex items-center gap-2.5 p-3 border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-[#0f172a] rounded-xl transition-all shadow-sm text-slate-700 dark:text-slate-300">
                                            <div class="radio-circle w-3.5 h-3.5 rounded-full border-2 border-slate-300 dark:border-slate-600 flex-shrink-0 transition-all"></div><span class="text-[11px] font-bold">Luar Tanggungan</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div id="wrapper_kategori_tahunan">
                                <label class="block text-[10px] font-medium text-slate-500 dark:text-slate-400 mb-2">Opsi Cuti Tahunan</label>
                                <div class="flex gap-2.5">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="kategori_tahunan" value="Keperluan Keluarga" class="peer sr-only">
                                        <div class="px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-[#0f172a] text-[11px] font-bold text-slate-600 dark:text-slate-400 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 peer-checked:text-blue-700 dark:peer-checked:text-blue-400 peer-checked:border-blue-500 dark:peer-checked:border-blue-500 transition-colors shadow-sm">Keperluan Keluarga</div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="kategori_tahunan" value="Istirahat" class="peer sr-only">
                                        <div class="px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-[#0f172a] text-[11px] font-bold text-slate-600 dark:text-slate-400 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 peer-checked:text-blue-700 dark:peer-checked:text-blue-400 peer-checked:border-blue-500 dark:peer-checked:border-blue-500 transition-colors shadow-sm">Istirahat</div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="kategori_tahunan" value="" class="peer sr-only" checked>
                                        <div class="px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-[#0f172a] text-[11px] font-bold text-slate-600 dark:text-slate-400 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 peer-checked:text-blue-700 dark:peer-checked:text-blue-400 peer-checked:border-blue-500 dark:peer-checked:border-blue-500 transition-colors shadow-sm">Lainnya</div>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label id="label_alasan_cuti" class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2.5">Detail Alasan / Lainnya <span class="text-rose-500">*</span></label>
                                <textarea id="input_alasan" name="alasan" rows="3" class="w-full px-4 py-3 bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-4 focus:ring-blue-500/10 dark:focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 dark:text-slate-200 outline-none text-xs transition-all shadow-sm placeholder-slate-400 dark:placeholder-slate-600" placeholder="Ketik alasan secara detail di sini..." required></textarea>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-5">
                            <div>
                                <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2.5">Waktu Pelaksanaan <span class="text-rose-500">*</span></label>
                                <div class="grid grid-cols-2 gap-3 mb-3">
                                    <div>
                                        <label class="block text-[10px] font-medium text-slate-500 dark:text-slate-400 mb-1.5">Mulai Tanggal</label>
                                        <div class="relative">
                                            <input type="text" id="mulai_tanggal" name="mulai_tanggal" class="w-full pl-4 pr-9 py-2.5 bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-4 focus:ring-blue-500/10 dark:focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 outline-none text-xs dark:text-slate-200 cursor-pointer shadow-sm transition-all" placeholder="Pilih kalender..." required>
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-medium text-slate-500 dark:text-slate-400 mb-1.5">Sampai Dengan (s/d)</label>
                                        <div class="relative">
                                            <input type="text" id="sampai_tanggal" name="sampai_tanggal" class="w-full pl-4 pr-9 py-2.5 bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-4 focus:ring-blue-500/10 dark:focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 outline-none text-xs dark:text-slate-200 cursor-pointer shadow-sm transition-all" placeholder="Pilih kalender..." required>
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-medium text-slate-500 dark:text-slate-400 mb-1.5">Total Durasi (Otomatis)</label>
                                    <div class="relative">
                                        <input type="number" id="durasi_input" name="durasi" min="1" class="w-full px-4 py-2.5 bg-slate-50/50 dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl outline-none text-sm pr-12 font-black text-slate-800 dark:text-slate-200 shadow-sm" placeholder="0" required readonly>
                                        <span class="absolute right-4 top-2.5 text-[10px] font-bold text-slate-400 dark:text-slate-500">HARI</span>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-2">
                                <h3 class="font-bold text-slate-800 dark:text-slate-200 text-[11px] mb-2 uppercase tracking-wide">V. Sisa Hak Cuti (Simulasi Tahunan)</h3>
                                <div class="border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden shadow-sm">
                                    <table class="table-formal text-[10px] w-full bg-white dark:bg-slate-900 text-center">
                                        <thead class="bg-slate-50 dark:bg-slate-800/80 font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                            <tr>
                                                <th class="py-2.5 px-2">Tahun</th>
                                                <th colspan="2" class="py-2.5 px-2">Sisa</th>
                                                <th class="py-2.5 px-2">Keterangan</th>
                                            </tr>
                                            <tr class="bg-white dark:bg-slate-900 text-[9px] border-t border-slate-100 dark:border-slate-800">
                                                <th class="py-1.5 border-r border-slate-100 dark:border-slate-800"></th>
                                                <th class="py-1.5 border-r border-slate-100 dark:border-slate-800">Semula</th>
                                                <th class="py-1.5 border-r border-slate-100 dark:border-slate-800">Menjadi</th>
                                                <th class="py-1.5"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="font-bold text-slate-800 dark:text-slate-200">
                                            <tr class="sim-row-n2 border-t border-slate-200 dark:border-slate-800">
                                                <td class="py-2 text-slate-500 dark:text-slate-400 border-r border-slate-100 dark:border-slate-800">N-2</td>
                                                <td id="sim_semula_n2" class="border-r border-slate-100 dark:border-slate-800">0</td>
                                                <td id="sim_menjadi_n2" class="border-r border-slate-100 dark:border-slate-800">0</td>
                                                <td class="font-medium text-slate-500 dark:text-slate-400">{{ $tahunBerjalan - 2 }}</td>
                                            </tr>
                                            <tr class="sim-row-n1 border-t border-slate-100 dark:border-slate-800">
                                                <td class="py-2 text-slate-500 dark:text-slate-400 border-r border-slate-100 dark:border-slate-800">N-1</td>
                                                <td id="sim_semula_n1" class="border-r border-slate-100 dark:border-slate-800">0</td>
                                                <td id="sim_menjadi_n1" class="border-r border-slate-100 dark:border-slate-800">0</td>
                                                <td class="font-medium text-slate-500 dark:text-slate-400">{{ $tahunBerjalan - 1 }}</td>
                                            </tr>
                                            <tr class="sim-row-n bg-blue-50/30 dark:bg-blue-900/10 border-t border-slate-100 dark:border-slate-800">
                                                <td class="py-2 border-r border-slate-100 dark:border-slate-800">N</td>
                                                <td id="sim_semula_n" class="border-r border-slate-100 dark:border-slate-800">12</td>
                                                <td id="sim_menjadi_n" class="border-r border-slate-100 dark:border-slate-800 text-blue-600 dark:text-blue-400">12</td>
                                                <td class="font-medium text-slate-500 dark:text-slate-400">{{ $tahunBerjalan }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-7 py-5 bg-transparent flex justify-end gap-3 rounded-b-3xl mt-1">
                    <button type="button" onclick="closeModal('modalInputCuti')" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800/80 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 rounded-xl text-[13px] font-bold transition-colors">Batal</button>
                    <button type="submit" class="flex items-center gap-1.5 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-[13px] font-bold transition-all active:scale-95 shadow-md shadow-blue-500/20 dark:shadow-none">
                        Simpan Data Cuti
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL TAMBAH PEGAWAI -->
    <div id="modalTambahPegawai" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
        <div class="modal-overlay absolute w-full h-full bg-slate-900/40 dark:bg-slate-900/80 backdrop-blur-[2px] transition-opacity"></div>
        <div class="modal-container bg-white dark:bg-[#111827] w-11/12 md:max-w-xl mx-auto rounded-3xl shadow-[0_20px_60px_-15px_rgba(0,0,0,0.3)] dark:shadow-none border border-white/20 dark:border-slate-800 z-50 overflow-y-auto max-h-[90vh] transition-all transform scale-95 duration-300">
            <form action="{{ route('pegawai.store') }}" method="POST" class="p-0">
                @csrf
                <div class="px-7 py-5 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-transparent">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">Tambah Data Pegawai</h2>
                        <p class="text-[11px] font-medium text-slate-400 dark:text-slate-500 mt-0.5">Formulir Perekaman Pegawai BNN Kabupaten Malang</p>
                    </div>
                    <button type="button" onclick="closeModal('modalTambahPegawai')" class="text-slate-400 hover:text-rose-500 dark:text-slate-500 dark:hover:text-rose-400 transition-colors p-2 rounded-full hover:bg-slate-50 dark:hover:bg-slate-800/50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <div class="px-7 py-6 space-y-5 text-sm bg-white dark:bg-[#111827]">
                    <div>
                        <label class="block font-bold text-slate-700 dark:text-slate-200 mb-1.5 text-xs">Nama Lengkap <span class="text-rose-500">*</span></label>
                        <input type="text" name="nama" required class="w-full px-4 py-2.5 bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-4 focus:ring-blue-500/10 dark:focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 dark:text-slate-200 outline-none transition-all placeholder-slate-400 dark:placeholder-slate-600 text-sm shadow-sm" placeholder="Masukkan nama lengkap beserta gelar...">
                    </div>
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block font-bold text-slate-700 dark:text-slate-200 mb-1.5 text-xs">NIP / NRP / NI PPPK</label>
                            <input type="text" name="nip_nrp" class="w-full px-4 py-2.5 bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-4 focus:ring-blue-500/10 dark:focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 dark:text-slate-200 outline-none transition-all placeholder-slate-400 dark:placeholder-slate-600 text-sm shadow-sm" placeholder="19850315 201001 1 002">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 dark:text-slate-200 mb-1.5 text-xs">Status Kepegawaian <span class="text-rose-500">*</span></label>
                            <select name="status" required class="w-full px-4 py-2.5 bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-4 focus:ring-blue-500/10 dark:focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 dark:text-slate-200 outline-none transition-all text-sm appearance-none shadow-sm font-semibold">
                                <option value="PNS">PNS</option>
                                <option value="PPPK">PPPK</option>
                                <option value="TNI">TNI</option>
                                <option value="POLRI">POLRI</option>
                                <option value="PPPK_PARUH_WAKTU">PPPK PARUH WAKTU</option>
                                <option value="OUTSOURCING">OUTSOURCING</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-end mb-2">
                            <label class="block font-bold text-slate-700 dark:text-slate-200 text-xs">Jabatan</label>
                            <span class="text-[10px] text-slate-400 dark:text-slate-500">Pilih opsi cepat atau ketik manual</span>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-3">
                            <button type="button" onclick="document.getElementById('add_jabatan').value='KEPALA BNN KAB. MALANG'; document.getElementById('add_jabatan').readOnly=true;" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-50 hover:bg-slate-100 dark:bg-slate-800/50 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 text-[10px] font-bold transition-colors">
                                <svg class="w-3 h-3 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                KEPALA BNN KAB. MALANG
                            </button>
                            <button type="button" onclick="document.getElementById('add_jabatan').value='KASUBBAG UMUM BNN KAB. MALANG'; document.getElementById('add_jabatan').readOnly=true;" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-50 hover:bg-slate-100 dark:bg-slate-800/50 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 text-[10px] font-bold transition-colors">
                                <svg class="w-3 h-3 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                KASUBBAG UMUM BNN KAB. MALANG
                            </button>
                            <button type="button" onclick="document.getElementById('add_jabatan').value=''; document.getElementById('add_jabatan').readOnly=false; document.getElementById('add_jabatan').focus();" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-transparent hover:bg-blue-50 dark:hover:bg-blue-900/20 text-blue-600 dark:text-blue-400 border border-transparent hover:border-blue-200 dark:hover:border-blue-800/50 text-[10px] font-bold transition-colors">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Ketik Manual
                            </button>
                        </div>
                        <input type="text" name="jabatan" id="add_jabatan" class="w-full px-4 py-2.5 bg-slate-50/50 dark:bg-[#0f172a]/50 border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-4 focus:ring-blue-500/10 dark:focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 dark:text-slate-200 outline-none transition-all placeholder-slate-400 dark:placeholder-slate-600 text-sm shadow-inner" placeholder="Pilih opsi di atas atau ketik manual...">
                    </div>
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block font-bold text-slate-700 dark:text-slate-200 mb-1.5 text-xs">Pangkat</label>
                            <input type="text" name="pangkat" class="w-full px-4 py-2.5 bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-4 focus:ring-blue-500/10 dark:focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 dark:text-slate-200 outline-none transition-all placeholder-slate-400 dark:placeholder-slate-600 text-sm shadow-sm" placeholder="Contoh: Penata Muda">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 dark:text-slate-200 mb-1.5 text-xs">Golongan</label>
                            <input type="text" name="golongan" class="w-full px-4 py-2.5 bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-4 focus:ring-blue-500/10 dark:focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 dark:text-slate-200 outline-none transition-all placeholder-slate-400 dark:placeholder-slate-600 text-sm shadow-sm" placeholder="Contoh: III-a">
                        </div>
                    </div>
                </div>
                <div class="px-7 py-5 bg-transparent flex justify-end gap-3 rounded-b-3xl mt-2">
                    <button type="button" onclick="closeModal('modalTambahPegawai')" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800/80 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 rounded-xl text-[13px] font-bold transition-colors">Batal</button>
                    <button type="submit" class="flex items-center gap-1.5 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-[13px] font-bold transition-all active:scale-95 shadow-md shadow-blue-500/20 dark:shadow-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Pegawai
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIKA, KALENDER, & SWEETALERT PIN -->
    <script>
        const dateConfig = { locale: "id", dateFormat: "Y-m-d", altInput: true, altFormat: "d F Y", onChange: hitungDurasi };
        const fpMulai = flatpickr("#mulai_tanggal", dateConfig);
        const fpSampai = flatpickr("#sampai_tanggal", dateConfig);
        const durasiInput = document.getElementById('durasi_input');

        let saldoN = 0, saldoN1 = 0, saldoN2 = 0;

        function openModalAturCuti(id, nama, status, hakN, sisaN1, sisaN2) {
            document.getElementById('atur_employee_name').innerText = nama;
            document.getElementById('input_cuti_n').value = hakN;

            const wrapN1 = document.getElementById('wrapper_cuti_n1');
            const wrapN2 = document.getElementById('wrapper_cuti_n2');
            const inputN1 = document.getElementById('input_sisa_n1');
            const inputN2 = document.getElementById('input_sisa_n2');

            if (status === 'PPPK_PARUH_WAKTU' || status === 'OUTSOURCING') {
                wrapN1.style.display = 'none'; wrapN2.style.display = 'none';
                inputN1.value = 0; inputN2.value = 0;
            } else {
                wrapN1.style.display = 'block'; wrapN2.style.display = 'block';
                inputN1.value = sisaN1; inputN2.value = sisaN2;
            }

            const pinInput = document.querySelector('#modalAturCuti input[name="pin"]');
            if(pinInput) pinInput.value = '';

            document.getElementById('formAturCuti').action = `/pegawai/${id}/saldo`;
            openModal('modalAturCuti');
        }

        function openModalInputCuti(id, nama, status, sisaTotal, vN, vN1, vN2) {
            document.getElementById('input_employee_id').value = id;
            document.getElementById('display_employee_name').innerText = nama;

            saldoN = vN; saldoN1 = vN1; saldoN2 = vN2;

            document.getElementById('sim_semula_n2').innerText = saldoN2;
            document.getElementById('sim_semula_n1').innerText = saldoN1;
            document.getElementById('sim_semula_n').innerText = saldoN;

            if (status === 'PPPK_PARUH_WAKTU' || status === 'OUTSOURCING') {
                document.querySelector('.sim-row-n2').style.display = 'none';
                document.querySelector('.sim-row-n1').style.display = 'none';
            } else {
                document.querySelector('.sim-row-n2').style.display = 'table-row';
                document.querySelector('.sim-row-n1').style.display = 'table-row';
            }

            document.querySelector('input[name="kategori_tahunan"][value=""]').checked = true;
            document.querySelector('input[name="jenis_cuti"][value="Cuti Tahunan"]').checked = true;
            document.getElementById('wrapper_kategori_tahunan').style.display = 'block';

            document.getElementById('label_alasan_cuti').innerHTML = 'Alasan <span class="text-rose-500">*</span>';
            document.getElementById('input_alasan').value = '';

            fpMulai.clear(); fpSampai.clear(); durasiInput.value = '';
            updateSimulasi(0);
            openModal('modalInputCuti');
        }

        function hitungDurasi() {
            const valMulai = document.getElementById('mulai_tanggal').value;
            const valSampai = document.getElementById('sampai_tanggal').value;
            if (valMulai && valSampai) {
                const diff = new Date(valSampai).getTime() - new Date(valMulai).getTime();
                const days = Math.ceil(diff / (1000 * 3600 * 24)) + 1;
                durasiInput.value = days > 0 ? days : 0;
                updateSimulasi(parseInt(durasiInput.value));
            } else {
                durasiInput.value = 0;
                updateSimulasi(0);
            }
        }

        document.querySelectorAll('input[name="jenis_cuti"]').forEach(radio => {
            radio.addEventListener('change', (e) => {
                updateSimulasi(parseInt(durasiInput.value) || 0);
                const wrapperKategori = document.getElementById('wrapper_kategori_tahunan');
                if (e.target.value === 'Cuti Tahunan') {
                    wrapperKategori.style.display = 'block';
                } else {
                    wrapperKategori.style.display = 'none';
                }
            });
        });

        function updateSimulasi(durasi) {
            const jenisCuti = document.querySelector('input[name="jenis_cuti"]:checked').value;
            let potong = (jenisCuti === 'Cuti Tahunan') ? durasi : 0;
            let sN2 = saldoN2; let sN1 = saldoN1; let sN = saldoN;

            if (potong > 0) { let p = Math.min(potong, sN2); sN2 -= p; potong -= p; }
            if (potong > 0) { let p = Math.min(potong, sN1); sN1 -= p; potong -= p; }
            if (potong > 0) { let p = Math.min(potong, sN); sN -= p; potong -= p; }

            document.getElementById('sim_menjadi_n2').innerText = sN2;
            document.getElementById('sim_menjadi_n1').innerText = sN1;
            document.getElementById('sim_menjadi_n').innerText = sN;

            const isDark = document.documentElement.classList.contains('dark');
            const defaultColor = isDark ? 'font-bold text-slate-200' : 'font-bold text-slate-800';
            const alertColor = isDark ? 'font-bold text-rose-400' : 'font-bold text-rose-600';

            document.getElementById('sim_menjadi_n2').className = (sN2 < saldoN2) ? alertColor : defaultColor;
            document.getElementById('sim_menjadi_n1').className = (sN1 < saldoN1) ? alertColor : defaultColor;
            document.getElementById('sim_menjadi_n').className = (sN < saldoN) ? alertColor : defaultColor;
        }

        function filterPegawai() {
            let input = document.getElementById("searchPegawai");
            let filter = input.value.toLowerCase();
            let tableBody = document.getElementById("tabelPegawai");
            let rows = tableBody.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                let infoCol = rows[i].getElementsByTagName("td")[1];
                if (infoCol) {
                    let txtValue = infoCol.textContent || infoCol.innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }
                }
            }
        }

        function updateRealtimeClock() {
            const now = new Date();
            const optionsDate = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            const dateStr = now.toLocaleDateString('id-ID', optionsDate);
            const timeStr = now.toLocaleTimeString('id-ID', optionsTime).replace(/\./g, ':');
            const clockEl = document.getElementById('realtime-clock');
            if(clockEl) clockEl.innerText = dateStr + ' - ' + timeStr + ' WIB';
        }
        setInterval(updateRealtimeClock, 1000);
        updateRealtimeClock();

        // SWEETALERT HAPUS PEGAWAI
        // SWEETALERT HAPUS PEGAWAI (SOFT MAC UI)
        function konfirmasiHapusPegawai(btn, nama) {
            Swal.fire({
                html: `
                    <div class="flex flex-col items-center pt-3 pb-1">
                        <div class="w-14 h-14 bg-orange-50 dark:bg-orange-500/10 border border-orange-200 dark:border-orange-500/30 rounded-full flex items-center justify-center mb-4 shadow-sm relative">
                            <div class="absolute inset-0 bg-orange-400 dark:bg-orange-500/20 blur-[10px] opacity-40 rounded-full"></div>
                            <svg class="w-6 h-6 text-orange-500 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <h2 class="text-[1.35rem] font-extrabold text-slate-800 dark:text-slate-100 tracking-tight mb-2">Otorisasi Diperlukan</h2>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium mb-6 text-center leading-relaxed px-2">
                            Masukkan PIN 6-Digit Anda untuk menghapus data <br><b class="text-slate-700 dark:text-slate-200">${nama}</b> secara permanen.
                        </p>

                        <input type="password" id="custom-pin-hapus" maxlength="6" autocomplete="new-password" class="w-full px-4 py-3.5 text-center tracking-[0.75em] font-mono text-xl bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-4 focus:ring-rose-500/10 dark:focus:ring-rose-500/20 focus:border-rose-500 dark:focus:border-rose-500 outline-none text-slate-800 dark:text-slate-200 shadow-sm transition-all mb-3 placeholder:tracking-normal placeholder:text-sm placeholder:text-slate-300 dark:placeholder:text-slate-600" placeholder="••••••">

                        <div class="flex items-center justify-center gap-1.5 text-[10px] font-bold text-rose-500 dark:text-rose-400 mt-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Tindakan permanen: Data riwayat cuti dan berkas akan dihapus.
                        </div>
                    </div>
                `,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                buttonsStyling: false,
                confirmButtonText: 'Verifikasi & Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                showClass: {
                    popup: 'animate-fade-in-up'
                },
                customClass: {
                    popup: 'bg-white dark:bg-[#111827] rounded-[1.5rem] shadow-[0_20px_60px_-15px_rgba(0,0,0,0.3)] dark:shadow-none border border-slate-100 dark:border-slate-800 p-2 sm:max-w-[24rem]',
                    htmlContainer: 'm-0 p-0',
                    closeButton: 'text-slate-400 hover:text-rose-500 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-full transition-colors mt-2 mr-2 focus:outline-none',
                    actions: 'flex gap-3 w-full justify-center px-5 pb-4 mt-6',
                    confirmButton: 'px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-[13px] font-bold transition-all active:scale-95 shadow-md shadow-rose-600/20 flex-1',
                    cancelButton: 'px-5 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800/80 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 rounded-xl text-[13px] font-bold transition-colors flex-1'
                },
                preConfirm: () => {
                    const pin = document.getElementById('custom-pin-hapus').value;
                    if (!pin) {
                        Swal.showValidationMessage('<span class="text-xs font-bold text-rose-500">PIN tidak boleh kosong!</span>');
                    } else if (pin.length < 6) {
                        Swal.showValidationMessage('<span class="text-xs font-bold text-rose-500">PIN harus 6 digit!</span>');
                    }
                    return pin;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = btn.closest('form');
                    let pinInput = document.createElement('input');
                    pinInput.type = 'hidden';
                    pinInput.name = 'pin';
                    pinInput.value = result.value;
                    form.appendChild(pinInput);
                    form.submit();
                } else {
                    document.getElementById("searchPegawai").value = "";
                    filterPegawai();
                }
            });
        }

        // SWEETALERT BATALKAN CUTI
        // SWEETALERT BATALKAN CUTI (SOFT MAC UI)
        function konfirmasiBatalkanCuti(btn, jenisCuti) {
            // Lencana khusus jika yang dibatalkan adalah Cuti Tahunan
            let textTambahan = jenisCuti === 'Cuti Tahunan' ? `
                <div class="flex items-center justify-center gap-1.5 text-[10px] font-bold text-emerald-600 dark:text-emerald-400 mt-3 bg-emerald-50 dark:bg-emerald-500/10 px-3 py-1.5 rounded-lg border border-emerald-100 dark:border-emerald-500/20">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    Saldo cuti tahunan akan dikembalikan otomatis.
                </div>
            ` : '';

            Swal.fire({
                html: `
                    <div class="flex flex-col items-center pt-3 pb-1">
                        <div class="w-14 h-14 bg-rose-50 dark:bg-rose-500/10 border border-rose-200 dark:border-rose-500/30 rounded-full flex items-center justify-center mb-4 shadow-sm relative">
                            <div class="absolute inset-0 bg-rose-400 dark:bg-rose-500/20 blur-[10px] opacity-40 rounded-full"></div>
                            <svg class="w-6 h-6 text-rose-500 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <h2 class="text-[1.35rem] font-extrabold text-slate-800 dark:text-slate-100 tracking-tight mb-2">Batalkan Cuti?</h2>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium text-center leading-relaxed px-2">
                            Yakin membatalkan pengajuan <br><b class="text-slate-700 dark:text-slate-200">${jenisCuti}</b> ini?
                        </p>
                        ${textTambahan}
                    </div>
                `,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                buttonsStyling: false,
                confirmButtonText: 'Ya, Batalkan',
                cancelButtonText: 'Kembali',
                reverseButtons: true,
                showClass: {
                    popup: 'animate-fade-in-up'
                },
                customClass: {
                    popup: 'bg-white dark:bg-[#111827] rounded-[1.5rem] shadow-[0_20px_60px_-15px_rgba(0,0,0,0.3)] dark:shadow-none border border-slate-100 dark:border-slate-800 p-2 sm:max-w-[24rem]',
                    htmlContainer: 'm-0 p-0',
                    closeButton: 'text-slate-400 hover:text-rose-500 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-full transition-colors mt-2 mr-2 focus:outline-none',
                    actions: 'flex gap-3 w-full justify-center px-5 pb-4 mt-6',
                    confirmButton: 'px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-[13px] font-bold transition-all active:scale-95 shadow-md shadow-rose-600/20 flex-1',
                    cancelButton: 'px-5 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800/80 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 rounded-xl text-[13px] font-bold transition-colors flex-1'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.closest('form').submit();
                }
            });
        }

        function openModal(id) {
            const modal = document.getElementById(id);
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.querySelector('.modal-container').classList.remove('scale-95');
        }
        function closeModal(id) {
            const modal = document.getElementById(id);
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.querySelector('.modal-container').classList.add('scale-95');
        }
        window.onclick = function(e) { if (e.target.classList.contains('modal-overlay')) closeModal(e.target.parentElement.id); }
    </script>

    @if(session('new_employee_id'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                openModalAturCuti({{ session('new_employee_id') }}, '{!! addslashes(session('new_employee_nama')) !!}', '{{ session('new_employee_status') }}', 12, 0, 0);
            }, 300);
        });
    </script>
    @endif
</body>
</html>
