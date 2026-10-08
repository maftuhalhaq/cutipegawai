<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Pegawai - SI-CUTE BNNK Malang</title>

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
        .modal { transition: opacity 0.3s ease-in-out; }
        .radio-card-input:checked + .radio-card-body { border-color: #3b82f6; background-color: #eff6ff; color: #1e3a8a; }
        .radio-card-input:checked + .radio-card-body .radio-circle { border-color: #3b82f6; background-color: #3b82f6; box-shadow: inset 0 0 0 3px #eff6ff; }
        .dark .radio-card-input:checked + .radio-card-body { border-color: #3b82f6; background-color: rgba(59, 130, 246, 0.15); color: #bfdbfe; }
        .dark .radio-card-input:checked + .radio-card-body .radio-circle { border-color: #60a5fa; background-color: #3b82f6; box-shadow: inset 0 0 0 3px #0f172a; }
        .table-formal { width: 100%; border-collapse: collapse; }
        .table-formal th, .table-formal td { border: 1px solid #cbd5e1; padding: 0.75rem 1rem; vertical-align: middle; }
        .dark .table-formal th, .dark .table-formal td { border-color: #334155; }
        .swal2-popup { font-family: 'figtree', sans-serif !important; border-radius: 1.5rem !important; }
        .swal2-title { font-weight: 800 !important; font-size: 1.5rem !important; }
        .swal2-confirm, .swal2-cancel { border-radius: 0.75rem !important; font-weight: 700 !important; font-size: 0.875rem !important; padding: 0.75rem 1.5rem !important; transition: all 0.2s !important; }
        .swal2-confirm:active, .swal2-cancel:active { transform: scale(0.95); }
        .dark .swal2-popup { background-color: #0f172a !important; color: #f8fafc !important; border: 1px solid #1e293b !important; }
        .dark .swal2-title { color: #f8fafc !important; }
        .dark .swal2-html-container { color: #94a3b8 !important; }
        .custom-scrollbar::-webkit-scrollbar { height: 6px; width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 20px; }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #334155; }
    </style>
</head>
<body class="bg-slate-100/80 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased relative selection:bg-blue-600 selection:text-white flex items-center justify-center min-h-screen py-8 px-4 sm:px-8 transition-colors duration-300">

    <div class="w-full max-w-[1200px] bg-white dark:bg-slate-900 rounded-[1.5rem] shadow-2xl dark:shadow-[0_20px_50px_rgba(0,0,0,0.6)] overflow-hidden flex flex-col border border-slate-300 dark:border-slate-800 animate-fade-in-up opacity-0">

        <!-- Top Bar (Mac UI) -->
        <div class="bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800/60 px-5 py-3 flex items-center justify-between">
            <div class="flex items-center space-x-6">
                <div class="flex items-center gap-1.5">
                    <div class="w-3.5 h-3.5 rounded-full bg-red-500 shadow-inner"></div>
                    <div class="w-3.5 h-3.5 rounded-full bg-yellow-400 shadow-inner"></div>
                    <div class="w-3.5 h-3.5 rounded-full bg-green-500 shadow-inner"></div>
                </div>
                <div class="flex items-center text-xs font-bold text-slate-500 dark:text-slate-400">
                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Portal Cuti <span class="mx-2 text-slate-300 dark:text-slate-600">/</span> <span class="text-slate-800 dark:text-slate-200">Panel Pegawai</span>
                </div>
            </div>
            <div class="text-[10px] font-bold text-slate-500 dark:text-slate-400 tracking-wide border border-slate-200 dark:border-slate-700/80 rounded-md px-3 py-1 flex items-center bg-slate-50 dark:bg-slate-800/50">
                <span class="text-slate-700 dark:text-slate-200">SI-CUTE</span> <span class="mx-1.5 font-normal text-slate-300 dark:text-slate-600">|</span> BNN Kab. Malang
            </div>
        </div>

        <!-- Sub Header -->
        <div class="bg-slate-50/50 dark:bg-slate-800/30 border-b border-slate-100 dark:border-slate-800/60 px-5 py-2.5 flex items-center justify-between text-[11px] font-medium text-slate-500 dark:text-slate-400">
            <div class="flex items-center space-x-3">
                <span class="text-blue-600 dark:text-blue-400 font-semibold">Tahun Aktif: {{ $tahunBerjalan }}</span>
                <span class="text-slate-300 dark:text-slate-600">•</span>
                <span id="realtime-clock">Memuat waktu...</span>
            </div>
            <div class="flex items-center space-x-3">
                <div class="flex items-center gap-2 text-emerald-600 dark:text-emerald-400 font-semibold">
                    <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></div>
                    Pegawai
                </div>
                <span class="text-slate-300 dark:text-slate-600">•</span>
                <span class="font-bold text-slate-800 dark:text-slate-200">{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="m-0 p-0 ml-2">
                    @csrf
                    <button type="submit" class="p-1 rounded text-slate-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-colors" title="Keluar">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </div>

        <div class="flex-1 bg-white dark:bg-slate-900 p-8 overflow-y-auto">

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

            <!-- KARTU INFO PEGAWAI & SISA CUTI -->
            <div class="bg-white dark:bg-[#111827] rounded-3xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden mb-8 p-6 lg:p-8 grid grid-cols-1 md:grid-cols-2 gap-6 items-center relative animate-fade-in-up animation-delay-100">
                <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50 dark:bg-blue-900/10 rounded-full blur-3xl opacity-50 -z-10 pointer-events-none"></div>
                <div>
                    <p class="text-[10px] font-bold text-blue-600 dark:text-blue-400 tracking-widest uppercase mb-2">Informasi Kepegawaian</p>
                    <h2 class="text-2xl lg:text-3xl font-extrabold text-slate-900 dark:text-slate-100 tracking-tight">{{ $pegawai->nama }}</h2>
                    <p class="text-slate-500 dark:text-slate-400 font-medium mt-1 text-sm">{{ $pegawai->jabatan ?? 'Jabatan Belum Diatur' }}</p>
                    <div class="mt-5 flex flex-wrap gap-2">
                        <span class="bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm">NIP: {{ $pegawai->nip_nrp ?? '-' }}</span>
                        <span class="bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm">{{ $pegawai->status }}</span>
                        
                        <!-- TOMBOL LIHAT PROFIL -->
                        <button onclick="openModal('modalLihatProfil')" class="bg-blue-600 dark:bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm hover:bg-blue-700 dark:hover:bg-blue-700 transition-colors flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Lihat Profil Data
                        </button>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-blue-600 to-blue-800 dark:from-blue-700 dark:to-slate-800 rounded-2xl p-6 text-white shadow-xl flex justify-between items-center border border-blue-500/30 dark:border-slate-700">
                    <div>
                        <p class="text-blue-200 dark:text-slate-300 text-xs font-medium mb-1 tracking-wide uppercase">Total Sisa Cuti Tahunan</p>
                        <div class="text-5xl font-black">{{ $sisaHari }} <span class="text-lg font-medium text-blue-200">Hari</span></div>
                        <p class="text-[10px] text-blue-300 dark:text-slate-400 mt-2">Hak cuti berlaku untuk tahun {{ $tahunBerjalan }}</p>
                    </div>
                    <button onclick="openModal('modalInputCuti')" class="bg-white dark:bg-blue-500 text-blue-800 dark:text-white hover:bg-blue-50 dark:hover:bg-blue-600 px-5 py-4 rounded-xl text-sm font-bold shadow-lg transition-all active:scale-95 flex flex-col items-center gap-1.5">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Ajukan Cuti
                    </button>
                </div>
            </div>

            <!-- TABEL RIWAYAT CUTI PEGAWAI -->
            <div class="animate-fade-in-up animation-delay-200">
                <h3 class="text-lg font-extrabold text-slate-800 dark:text-slate-100 tracking-tight mb-4">Riwayat Pengajuan Cuti Anda</h3>
                <div class="bg-white dark:bg-[#111827] rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                    <div class="overflow-x-auto custom-scrollbar">
                        <table class="min-w-full text-left border-collapse">
                            <thead class="bg-slate-50 dark:bg-slate-800/40 text-[10px] text-slate-500 dark:text-slate-400 uppercase tracking-wider text-center font-bold border-b border-slate-100 dark:border-slate-800">
                                <tr>
                                    <th class="px-5 py-4 border-r border-slate-100 dark:border-slate-800/60">Jenis Cuti</th>
                                    <th class="px-5 py-4 border-r border-slate-100 dark:border-slate-800/60 w-1/3">Alasan / Keterangan</th>
                                    <th class="px-5 py-4 border-r border-slate-100 dark:border-slate-800/60">Tanggal Pelaksanaan</th>
                                    <th class="px-5 py-4 border-r border-slate-100 dark:border-slate-800/60">Status</th>
                                    <th class="px-5 py-4">Aksi Dokumen</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 bg-white dark:bg-transparent">
                                @forelse($riwayatCuti as $riwayat)
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors text-center group">
                                    <td class="px-5 py-4 border-r border-slate-100 dark:border-slate-800/60 font-bold text-slate-700 dark:text-slate-200 text-xs">{{ $riwayat->jenis_cuti }}</td>
                                    <td class="px-5 py-4 border-r border-slate-100 dark:border-slate-800/60 text-left text-slate-600 dark:text-slate-400 text-xs">{{ $riwayat->alasan }}</td>
                                    <td class="px-5 py-4 border-r border-slate-100 dark:border-slate-800/60">
                                        <div class="text-slate-700 dark:text-slate-300 font-bold text-xs">{{ \Carbon\Carbon::parse($riwayat->mulai_tanggal)->format('d M Y') }}</div>
                                        <div class="text-[10px] text-slate-400 dark:text-slate-500 my-0.5">s/d</div>
                                        <div class="text-slate-700 dark:text-slate-300 font-bold text-xs">{{ \Carbon\Carbon::parse($riwayat->sampai_tanggal)->format('d M Y') }}</div>
                                        <div class="text-[10px] font-bold text-blue-600 dark:text-blue-400 mt-1">({{ $riwayat->durasi }} Hari)</div>
                                    </td>
                                    <td class="px-5 py-4 border-r border-slate-100 dark:border-slate-800/60">
                                        @if($riwayat->status_pengajuan == 'Disetujui')
                                            <span class="bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20 px-3 py-1.5 rounded-md text-[10px] font-bold">Disetujui ✅</span>
                                        @elseif($riwayat->status_pengajuan == 'Ditolak')
                                            <span class="bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 border border-rose-200 dark:border-rose-500/20 px-3 py-1.5 rounded-md text-[10px] font-bold">Ditolak ❌</span>
                                        @else
                                            <span class="bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-200 dark:border-amber-500/20 px-3 py-1.5 rounded-md text-[10px] font-bold">Menunggu Validasi ⏳</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4">
                                        <div class="flex flex-col gap-2 items-center justify-center">
                                            <!-- Tombol Cetak / Preview Dokumen -->
                                            <button type="button" onclick="previewSurat('{{ route('cuti.cetak', $riwayat->id) }}', '{{ \Carbon\Carbon::parse($riwayat->created_at)->format('d M Y') }}')" class="inline-flex w-full justify-center items-center gap-1.5 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-800 text-blue-700 dark:text-blue-400 border border-blue-200 dark:border-blue-800/50 px-4 py-2 rounded-lg text-xs font-bold transition-colors shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                                Dokumen
                                            </button>
                                            
                                            <!-- Tombol Batalkan Cuti -->
                                            @if($riwayat->status_pengajuan == 'Menunggu')
                                            <form action="{{ route('cuti.destroy', $riwayat->id) }}" method="POST" class="m-0 p-0 w-full">
                                                @csrf @method('DELETE')
                                                <button type="button" onclick="konfirmasiBatalkanCuti(this, '{{ $riwayat->jenis_cuti }}')" class="w-full text-slate-500 hover:text-rose-600 dark:text-slate-400 dark:hover:text-rose-400 bg-slate-50 hover:bg-rose-50 dark:bg-slate-800/50 dark:hover:bg-rose-900/20 py-1.5 transition-colors border border-slate-200 dark:border-slate-700 hover:border-rose-200 dark:hover:border-rose-500/30 rounded-lg text-[10px] font-bold shadow-sm" title="Batalkan Pengajuan">
                                                    Batalkan
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-10 text-center text-slate-400 dark:text-slate-500 font-medium bg-slate-50/50 dark:bg-slate-800/20">
                                        <div class="flex flex-col items-center justify-center opacity-70">
                                            <div class="w-12 h-12 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-full flex items-center justify-center mb-3 shadow-sm">
                                                <svg class="w-6 h-6 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            </div>
                                            <p class="text-sm font-bold text-slate-600 dark:text-slate-300">Belum ada riwayat pengajuan cuti yang Anda buat.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="flex justify-end text-[10px] text-slate-400 dark:text-slate-500 mt-4 px-2 font-medium">
                v2.4.9 (macOS Soft-UI Dark)
            </div>
        </div>
    </div>

    <!-- MODAL INPUT CUTI PEGAWAI -->
    <div id="modalInputCuti" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
        <div class="modal-overlay absolute w-full h-full bg-slate-900/40 dark:bg-slate-900/80 backdrop-blur-[2px] transition-opacity"></div>
        <div class="modal-container bg-white dark:bg-[#111827] w-11/12 md:max-w-4xl mx-auto rounded-3xl shadow-[0_20px_60px_-15px_rgba(0,0,0,0.3)] dark:shadow-none border border-white/20 dark:border-slate-800 z-50 overflow-y-auto max-h-[95vh] transition-all transform scale-95 duration-300">
            <form action="{{ route('cuti.store') }}" method="POST" class="p-0">
                @csrf 
                <input type="hidden" name="employee_id" value="{{ $pegawai->id }}">
                
                <div class="px-7 py-5 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-transparent">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">Form Pengajuan Cuti</h2>
                        <p class="text-[11px] font-medium text-slate-400 dark:text-slate-500 mt-0.5">Sistem akan memotong sisa hak cuti Anda secara otomatis jika disetujui.</p>
                    </div>
                    <button type="button" onclick="closeModal('modalInputCuti')" class="text-slate-400 hover:text-rose-500 dark:text-slate-500 dark:hover:text-rose-400 transition-colors p-2 rounded-full hover:bg-slate-50 dark:hover:bg-slate-800/50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="px-7 py-6 space-y-6 bg-white dark:bg-[#111827]">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <!-- Left Column -->
                        <div class="space-y-5">
                            <div>
                                <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2.5">Pilih Jenis Cuti <span class="text-rose-500">*</span></label>
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
                                <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2.5">Data Administrasi <span class="text-rose-500">*</span></label>
                                <div class="grid grid-cols-2 gap-3 mb-3">
                                    <div>
                                        <label class="block text-[10px] font-medium text-slate-500 dark:text-slate-400 mb-1.5">Tanggal Surat Dibuat</label>
                                        <div class="relative">
                                            <input type="text" id="tanggal_surat" name="tanggal_surat" class="datepicker-baru w-full pl-4 pr-9 py-2.5 bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-4 focus:ring-blue-500/10 dark:focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 outline-none text-xs dark:text-slate-200 cursor-pointer shadow-sm transition-all" placeholder="Pilih tanggal surat..." required>
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-medium text-slate-500 dark:text-slate-400 mb-1.5">No. Telepon / WA</label>
                                        <input type="text" name="telepon" class="w-full px-4 py-2.5 bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-4 focus:ring-blue-500/10 dark:focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-500 outline-none text-xs dark:text-slate-200 shadow-sm transition-all" placeholder="Contoh: 0812345678" required>
                                    </div>
                                </div>
                            </div>
                            
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
                                    <label class="block text-[10px] font-medium text-slate-500 dark:text-slate-400 mb-1.5">Total Durasi</label>
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
                                                <td id="sim_semula_n2" class="border-r border-slate-100 dark:border-slate-800">{{ $valN2 }}</td>
                                                <td id="sim_menjadi_n2" class="border-r border-slate-100 dark:border-slate-800">{{ $valN2 }}</td>
                                                <td class="font-medium text-slate-500 dark:text-slate-400">{{ $tahunBerjalan - 2 }}</td>
                                            </tr>
                                            <tr class="sim-row-n1 border-t border-slate-100 dark:border-slate-800">
                                                <td class="py-2 text-slate-500 dark:text-slate-400 border-r border-slate-100 dark:border-slate-800">N-1</td>
                                                <td id="sim_semula_n1" class="border-r border-slate-100 dark:border-slate-800">{{ $valN1 }}</td>
                                                <td id="sim_menjadi_n1" class="border-r border-slate-100 dark:border-slate-800">{{ $valN1 }}</td>
                                                <td class="font-medium text-slate-500 dark:text-slate-400">{{ $tahunBerjalan - 1 }}</td>
                                            </tr>
                                            <tr class="sim-row-n bg-blue-50/30 dark:bg-blue-900/10 border-t border-slate-100 dark:border-slate-800">
                                                <td class="py-2 border-r border-slate-100 dark:border-slate-800">N</td>
                                                <td id="sim_semula_n" class="border-r border-slate-100 dark:border-slate-800">{{ $valN }}</td>
                                                <td id="sim_menjadi_n" class="border-r border-slate-100 dark:border-slate-800 text-blue-600 dark:text-blue-400">{{ $valN }}</td>
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
                        Kirim Pengajuan Cuti
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL LIHAT PROFIL PEGAWAI (READ ONLY) -->
    <div id="modalLihatProfil" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
        <div class="modal-overlay absolute w-full h-full bg-slate-900/40 dark:bg-slate-900/80 backdrop-blur-[2px] transition-opacity"></div>
        <div class="modal-container bg-white dark:bg-[#111827] w-11/12 md:max-w-2xl mx-auto rounded-3xl shadow-[0_20px_60px_-15px_rgba(0,0,0,0.3)] dark:shadow-none border border-white/20 dark:border-slate-800 z-50 overflow-y-auto max-h-[90vh] transition-all transform scale-95 duration-300">
            
            <div class="px-7 py-5 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-transparent">
                <div>
                    <h2 class="text-xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">Data Profil Pegawai</h2>
                    <p class="text-[11px] font-bold text-amber-600 dark:text-amber-500 mt-0.5 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Bersifat Read-Only. Hubungi Subbag Umum (Admin) jika ada ketidaksesuaian data.
                    </p>
                </div>
                <button type="button" onclick="closeModal('modalLihatProfil')" class="text-slate-400 hover:text-rose-500 dark:text-slate-500 dark:hover:text-rose-400 transition-colors p-2 rounded-full hover:bg-slate-50 dark:hover:bg-slate-800/50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <div class="px-7 py-6 space-y-5 text-sm bg-white dark:bg-[#111827]">
                <div class="grid grid-cols-2 gap-5 opacity-90">
                    <div class="col-span-2">
                        <label class="block font-bold text-slate-500 dark:text-slate-400 mb-1.5 text-xs">Nama Lengkap & Gelar</label>
                        <input type="text" value="{{ $pegawai->nama }}" readonly class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-700 dark:text-slate-300 outline-none text-sm cursor-not-allowed font-bold">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-500 dark:text-slate-400 mb-1.5 text-xs">NIP / NRP</label>
                        <input type="text" value="{{ $pegawai->nip_nrp ?? '-' }}" readonly class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-700 dark:text-slate-300 outline-none text-sm cursor-not-allowed font-bold">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-500 dark:text-slate-400 mb-1.5 text-xs">Username Login</label>
                        <input type="text" value="{{ auth()->user()->username }}" readonly class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-700 dark:text-slate-300 outline-none text-sm cursor-not-allowed font-bold lowercase">
                    </div>
                    <div class="col-span-2">
                        <label class="block font-bold text-slate-500 dark:text-slate-400 mb-1.5 text-xs">Jabatan</label>
                        <input type="text" value="{{ $pegawai->jabatan }}" readonly class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-700 dark:text-slate-300 outline-none text-sm cursor-not-allowed font-bold">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-500 dark:text-slate-400 mb-1.5 text-xs">Pangkat</label>
                        <input type="text" value="{{ $pegawai->pangkat ?? '-' }}" readonly class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-700 dark:text-slate-300 outline-none text-sm cursor-not-allowed font-bold">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-500 dark:text-slate-400 mb-1.5 text-xs">Golongan</label>
                        <input type="text" value="{{ $pegawai->golongan ?? '-' }}" readonly class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-700 dark:text-slate-300 outline-none text-sm cursor-not-allowed font-bold">
                    </div>
                    <div class="col-span-2">
                        <label class="block font-bold text-slate-500 dark:text-slate-400 mb-1.5 text-xs">Tanggal Mulai Kerja</label>
                        <input type="text" value="{{ $pegawai->tanggal_mulai_kerja ? \Carbon\Carbon::parse($pegawai->tanggal_mulai_kerja)->format('d F Y') : '-' }}" readonly class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-700 dark:text-slate-300 outline-none text-sm cursor-not-allowed font-bold">
                    </div>
                </div>
            </div>
            
            <div class="px-7 py-5 bg-transparent flex justify-end gap-3 rounded-b-3xl mt-1">
                <button type="button" onclick="closeModal('modalLihatProfil')" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-[13px] font-bold transition-all active:scale-95 shadow-md shadow-blue-500/20">
                    Tutup Profil
                </button>
            </div>
        </div>
    </div>

    <script>
        // Config khusus untuk rentang cuti yang memicu hitungDurasi otomatis
        const dateConfigCuti = { locale: "id", dateFormat: "Y-m-d", altInput: true, altFormat: "d F Y", onChange: hitungDurasi };
        const fpMulai = flatpickr("#mulai_tanggal", dateConfigCuti);
        const fpSampai = flatpickr("#sampai_tanggal", dateConfigCuti);
        
        // Config untuk tanggal biasa (Tanggal Surat dll) tanpa hitungDurasi
        flatpickr(".datepicker-baru", { locale: "id", dateFormat: "Y-m-d", altInput: true, altFormat: "d F Y" });
        
        const durasiInput = document.getElementById('durasi_input');

        let saldoN = {{ $valN }}, saldoN1 = {{ $valN1 }}, saldoN2 = {{ $valN2 }};

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
                const labelAlasan = document.getElementById('label_alasan_cuti');
                if (e.target.value === 'Cuti Tahunan') {
                    wrapperKategori.style.display = 'block';
                    labelAlasan.innerHTML = 'Detail Alasan / Lainnya <span class="text-rose-500">*</span>';
                } else {
                    wrapperKategori.style.display = 'none';
                    labelAlasan.innerHTML = 'Alasan Cuti <span class="text-rose-500">*</span>';
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

        // FUNGSI PREVIEW SURAT SEBELUM UNDUH
        function previewSurat(url, tanggal) {
            Swal.fire({
                html: `
                    <div class="flex flex-col items-center pt-4 pb-2">
                        <div class="w-16 h-16 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800/50 rounded-2xl flex items-center justify-center mb-5 shadow-sm transform -rotate-6">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h2 class="text-xl font-extrabold text-slate-800 dark:text-slate-100 tracking-tight mb-2">Dokumen Surat Cuti</h2>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium text-center leading-relaxed px-4 mb-4">
                            Dokumen surat cuti pengajuan tanggal <b>${tanggal}</b> akan digenerate ke dalam format <b>Microsoft Word (.docx)</b>.
                        </p>
                        <div class="bg-amber-50 dark:bg-amber-900/10 border border-amber-200 dark:border-amber-800/30 text-amber-700 dark:text-amber-500 text-[10px] font-bold px-3 py-2 rounded-lg flex items-center gap-2 w-full text-left">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Karena format file Word, browser akan langsung mengunduh file (bukan menampilkannya di layar).
                        </div>
                    </div>
                `,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: true,
                buttonsStyling: false,
                confirmButtonText: '<svg class="w-4 h-4 mr-1.5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg> Unduh File Word',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'bg-white dark:bg-[#111827] rounded-[1.5rem] shadow-[0_20px_60px_-15px_rgba(0,0,0,0.3)] dark:shadow-none border border-slate-100 dark:border-slate-800 p-2 sm:max-w-[26rem]',
                    htmlContainer: 'm-0 p-0',
                    closeButton: 'text-slate-400 hover:text-rose-500 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-full transition-colors mt-2 mr-2 focus:outline-none',
                    actions: 'flex gap-3 w-full justify-center px-5 pb-4 mt-5',
                    confirmButton: 'px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-[12px] font-bold transition-all active:scale-95 shadow-md shadow-blue-600/20 flex-1 flex justify-center',
                    cancelButton: 'px-5 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800/80 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 rounded-xl text-[12px] font-bold transition-colors flex-1'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url; // Memicu download
                }
            });
        }

        function konfirmasiBatalkanCuti(btn, jenisCuti) {
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
    </script>
</body>
</html>