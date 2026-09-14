<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JUDUL TAB BROWSER DIUBAH KE SI-CUTE -->
    <title>SI-CUTE - Dashboard Cuti BNNK Malang</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    <!-- SWEETALERT2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        .table-formal { width: 100%; border-collapse: collapse; }
        .table-formal th, .table-formal td { 
            border: 1px solid #0f172a; 
            padding: 0.75rem 1rem; 
            vertical-align: middle; 
        }
        .table-formal th { background-color: #f8fafc; color: #000; }
        .table-formal td { color: #000; }
        .modal { transition: opacity 0.2s ease-in-out; }
        .radio-card-input:checked + .radio-card-body { border-color: #3b82f6; background-color: #eff6ff; color: #1e3a8a; }
        .radio-card-input:checked + .radio-card-body .radio-circle { border-color: #3b82f6; background-color: #3b82f6; box-shadow: inset 0 0 0 3px #eff6ff; }
        
        .swal2-popup { font-family: 'Inter', sans-serif !important; border-radius: 1.5rem !important; }
        .swal2-title { font-weight: 700 !important; color: #1e293b !important; }
        .swal2-confirm, .swal2-cancel { border-radius: 0.75rem !important; font-weight: 600 !important; font-size: 0.875rem !important; padding: 0.625rem 1.25rem !important; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased relative">

    <nav class="bg-blue-800 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- NAMA DAN LOGO SI-CUTE -->
                <div class="flex items-center gap-3" title="Sistem Informasi CUTi Elektronik BNN Kabupaten Malang">
                    <div class="bg-white p-1.5 rounded-lg shadow-sm">
                        <svg class="w-6 h-6 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <div class="text-white font-bold text-xl tracking-widest leading-none">SI-CUTE</div>
                        <div class="text-[10px] text-blue-200 font-medium tracking-wide">BNN KAB. MALANG</div>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="text-blue-100 text-sm bg-blue-900 px-4 py-1.5 rounded-full border border-blue-700 shadow-inner flex items-center gap-3">
                        <span>Tahun Aktif: <span class="font-bold text-white">{{ $tahunBerjalan }}</span></span>
                        <div class="w-px h-4 bg-blue-700"></div>
                        <span class="font-medium text-white flex items-center gap-1.5">
                            <span id="realtime-clock">Memuat waktu...</span>
                        </span>
                        
                        <div class="w-px h-4 bg-blue-700"></div>
                        <!-- LINK PROFIL DAN PIN -->
                        <a href="{{ route('profil') }}" class="font-semibold text-blue-200 hover:text-white flex items-center gap-1 transition-colors text-sm" title="Pengaturan Profil & PIN">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Profil
                        </a>

                        <!-- TOMBOL LOGOUT -->
                        <div class="w-px h-4 bg-blue-700"></div>
                        <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="font-semibold text-red-300 hover:text-red-100 flex items-center gap-1 transition-colors text-sm" title="Keluar dari sistem">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        @if(session('success'))
        <div class="mb-6 bg-emerald-100 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm">
            <div class="bg-emerald-500 text-white rounded-full p-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></div>
            <div><span class="font-bold">Berhasil!</span> {{ session('success') }}</div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 bg-red-100 border border-red-200 text-red-800 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm">
            <div class="bg-red-500 text-white rounded-full p-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg></div>
            <div><span class="font-bold">Gagal!</span> {{ session('error') }}</div>
        </div>
        @endif

        <div class="flex justify-between items-end mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Data Pegawai & Cuti</h1>
                <p class="text-slate-500 text-sm mt-1">Kelola data pegawai, tinjau sisa cuti, dan catat riwayat pengajuan cuti baru.</p>
            </div>
            
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" id="searchPegawai" oninput="filterPegawai()" autocomplete="off" role="presentation" class="w-64 pl-9 pr-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm shadow-sm transition-all bg-white" placeholder="Cari nama / jabatan...">
                </div>
                <button onclick="openModal('modalTambahPegawai')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg text-sm font-semibold shadow-sm transition-colors flex items-center gap-2">
                    <span>+</span> Tambah Pegawai
                </button>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Informasi Pegawai</th>
                            <th class="px-4 py-4 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Golongan</th>
                            <th class="px-4 py-4 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-4 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Sisa Cuti</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi Kelola</th>
                        </tr>
                    </thead>
                    <tbody id="tabelPegawai" class="divide-y divide-slate-100 bg-white">
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

                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-slate-900">{{ $emp->nama }}</div>
                                <div class="text-xs text-slate-500 mt-0.5">{{ $emp->jabatan ?? '-' }}</div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                    {{ $emp->golongan ?? '-' }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200 uppercase">
                                    {{ str_replace('_', ' ', $emp->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                <div class="text-lg font-bold text-blue-600">
                                    {{ $sisaHari }} <span class="text-xs font-normal text-slate-500">Hari</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center space-x-1 flex justify-center items-center">
                                <button onclick="openModalAturCuti({{ $emp->id }}, '{{ addslashes($emp->nama) }}', '{{ $emp->status }}', {{ $hakDasarN }}, {{ $valN1 }}, {{ $valN2 }})" class="inline-flex items-center px-3 py-1.5 bg-purple-50 text-purple-700 hover:bg-purple-100 text-xs font-semibold rounded-lg transition-colors border border-purple-200 shadow-sm" title="Atur Hak Cuti Awal">
                                    Atur Hak Cuti
                                </button>
                                <button onclick="openModalInputCuti({{ $emp->id }}, '{{ addslashes($emp->nama) }}', '{{ $emp->status }}', {{ $sisaHari }}, {{ $valN }}, {{ min($valN1, 6) }}, {{ min($valN2, 6) }}, {{ $hakDasarN }})" class="inline-flex items-center px-3 py-1.5 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 text-xs font-semibold rounded-lg transition-colors border border-emerald-200 shadow-sm">
                                    + Input
                                </button>
                                <button onclick="openModal('modalProfil_{{ $emp->id }}')" class="inline-flex items-center px-3 py-1.5 bg-slate-100 text-slate-700 hover:bg-slate-200 text-xs font-semibold rounded-lg transition-colors border border-slate-300 shadow-sm">
                                    Edit Profil
                                </button>
                                <button onclick="openModal('modalDetailCuti_{{ $emp->id }}')" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 text-xs font-semibold rounded-lg transition-colors border border-blue-200 shadow-sm">
                                    Detail Cuti
                                </button>
                                <form action="{{ route('pegawai.destroy', $emp->id) }}" method="POST" class="m-0 p-0 inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="konfirmasiHapusPegawai(this, '{{ addslashes($emp->nama) }}')" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 text-xs font-semibold rounded-lg transition-colors border border-red-200 shadow-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

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
            <div class="modal-overlay absolute w-full h-full bg-slate-900 opacity-50 backdrop-blur-sm"></div>
            <div class="modal-container bg-white w-11/12 md:max-w-2xl mx-auto rounded-2xl shadow-xl z-50 overflow-y-auto max-h-[90vh]">
                <form action="{{ route('pegawai.update', $emp->id) }}" method="POST" class="p-0">
                    @csrf
                    @method('PUT')
                    <div class="px-8 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50 rounded-t-2xl">
                        <h2 class="text-xl font-bold text-slate-800">Profil & Edit Pegawai</h2>
                        <button type="button" onclick="closeModal('modalProfil_{{ $emp->id }}')" class="text-slate-400 hover:text-red-500 bg-slate-100 hover:bg-red-50 rounded-full p-1.5 transition-colors">✕</button>
                    </div>
                    <div class="px-8 py-8 space-y-6 text-sm">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="col-span-2">
                                <label class="block font-semibold text-slate-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="nama" value="{{ $emp->nama }}" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none shadow-sm">
                            </div>
                            <div>
                                <label class="block font-semibold text-slate-700 mb-2">NIP / NRP / NI PPPK</label>
                                <input type="text" name="nip_nrp" value="{{ $emp->nip_nrp }}" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none shadow-sm">
                            </div>
                            <div>
                                <label class="block font-semibold text-slate-700 mb-2">Status Kepegawaian <span class="text-red-500">*</span></label>
                                <select name="status" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none bg-white shadow-sm">
                                    <option value="PNS" {{ $emp->status == 'PNS' ? 'selected' : '' }}>PNS</option>
                                    <option value="PPPK" {{ $emp->status == 'PPPK' ? 'selected' : '' }}>PPPK</option>
                                    <option value="TNI" {{ $emp->status == 'TNI' ? 'selected' : '' }}>TNI</option>
                                    <option value="POLRI" {{ $emp->status == 'POLRI' ? 'selected' : '' }}>POLRI</option>
                                    <option value="PPPK_PARUH_WAKTU" {{ $emp->status == 'PPPK_PARUH_WAKTU' ? 'selected' : '' }}>PPPK PARUH WAKTU</option>
                                    <option value="OUTSOURCING" {{ $emp->status == 'OUTSOURCING' ? 'selected' : '' }}>OUTSOURCING</option>
                                </select>
                            </div>
                            <div class="col-span-2">
                                <label class="block font-semibold text-slate-700 mb-2">Jabatan</label>
                                <input type="text" name="jabatan" value="{{ $emp->jabatan }}" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none shadow-sm">
                            </div>
                            <div>
                                <label class="block font-semibold text-slate-700 mb-2">Pangkat</label>
                                <input type="text" name="pangkat" value="{{ $emp->pangkat }}" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none shadow-sm">
                            </div>
                            <div>
                                <label class="block font-semibold text-slate-700 mb-2">Golongan</label>
                                <input type="text" name="golongan" value="{{ $emp->golongan }}" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none shadow-sm">
                            </div>
                        </div>
                    </div>
                    <div class="px-8 py-5 border-t border-slate-100 bg-slate-50 flex justify-end gap-4 rounded-b-2xl">
                        <button type="button" onclick="closeModal('modalProfil_{{ $emp->id }}')" class="px-6 py-2.5 bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 rounded-xl text-sm font-semibold transition-colors shadow-sm">Batal</button>
                        <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-semibold transition-colors shadow-sm">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL DETAIL CUTI & RIWAYAT -->
        <div id="modalDetailCuti_{{ $emp->id }}" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
            <div class="modal-overlay absolute w-full h-full bg-slate-900 opacity-50 backdrop-blur-sm"></div>
            <div class="modal-container bg-white w-11/12 md:max-w-5xl mx-auto rounded-2xl shadow-2xl z-50 overflow-y-auto max-h-[90vh]">
                <div class="px-8 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50 rounded-t-2xl">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800">Detail Data Cuti Pegawai</h2>
                        <p class="text-sm font-medium text-slate-600 mt-0.5">{{ $emp->nama }}</p>
                    </div>
                    <button onclick="closeModal('modalDetailCuti_{{ $emp->id }}')" class="text-slate-400 hover:text-red-500 bg-white p-2 rounded-full shadow-sm border border-slate-200 transition-colors">✕</button>
                </div>

                <div class="p-8 space-y-6">
                    <div>
                        <h3 class="font-bold text-slate-800 text-sm mb-3">V. SISA HAK CUTI (MULTI-TAHUN)</h3>
                        <div class="border border-slate-200 rounded-xl overflow-hidden shadow-sm">
                            <table class="table-formal text-sm w-full">
                                <thead class="bg-slate-50 font-bold uppercase text-center">
                                    <tr>
                                        <th rowspan="2">Tahun</th>
                                        <th colspan="2">Sisa</th>
                                        <th rowspan="2">Keterangan</th>
                                    </tr>
                                    <tr>
                                        <th>Semula</th>
                                        <th>Menjadi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center font-bold text-base">
                                    @php
                                        $lastCutiTahunan = $emp->leaveHistories()
                                                               ->where('tahun', $tahunBerjalan)
                                                               ->where('jenis_cuti', 'Cuti Tahunan')
                                                               ->orderBy('created_at', 'desc')
                                                               ->first();
                                        
                                        $durasiTerakhir = $lastCutiTahunan ? $lastCutiTahunan->durasi : 0;
                                        
                                        $semulaN2 = $valN2;
                                        $semulaN1 = $valN1;
                                        $semulaN = $valN;
                                        
                                        $tempDurasi = $durasiTerakhir;
                                        
                                        if ($tempDurasi > 0 && $valN < $hakDasarN) {
                                             $spaceN = $hakDasarN - $valN;
                                             $addBackN = min($spaceN, $tempDurasi);
                                             $semulaN += $addBackN;
                                             $tempDurasi -= $addBackN;
                                        }

                                        if ($tempDurasi > 0 && $valN1 < $hakDasarN1) {
                                            $spaceN1 = $hakDasarN1 - $valN1;
                                            $addBackN1 = min($spaceN1, $tempDurasi);
                                            $semulaN1 += $addBackN1;
                                            $tempDurasi -= $addBackN1;
                                        }

                                        if ($tempDurasi > 0 && $valN2 < $hakDasarN2) {
                                            $spaceN2 = $hakDasarN2 - $valN2;
                                            $addBackN2 = min($spaceN2, $tempDurasi);
                                            $semulaN2 += $addBackN2;
                                        }
                                    @endphp

                                    @if($emp->status != 'PPPK_PARUH_WAKTU' && $emp->status != 'OUTSOURCING')
                                    <tr>
                                        <td>N-2 ({{ $tahunBerjalan - 2 }})</td>
                                        <td>{{ $semulaN2 }}</td>
                                        <td>{{ $valN2 }}</td>
                                        <td class="font-medium text-sm">{{ $tahunBerjalan - 2 }}</td>
                                    </tr>
                                    <tr>
                                        <td>N-1 ({{ $tahunBerjalan - 1 }})</td>
                                        <td>{{ $semulaN1 }}</td>
                                        <td>{{ $valN1 }}</td>
                                        <td class="font-medium text-sm">{{ $tahunBerjalan - 1 }}</td>
                                    </tr>
                                    @endif
                                    
                                    <tr>
                                        <td>N ({{ $tahunBerjalan }})</td>
                                        <td>{{ $semulaN }}</td>
                                        <td class="text-blue-600 text-lg">{{ $valN }}</td>
                                        <td class="font-medium text-sm">{{ $tahunBerjalan }} (Berjalan)</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <h3 class="font-bold text-slate-800 text-sm mb-3">VI. RIWAYAT PENGAJUAN CUTI (TAHUN {{ $tahunBerjalan }})</h3>
                        <div class="border border-slate-200 rounded-xl overflow-hidden shadow-sm">
                            <table class="w-full text-sm text-left divide-y divide-slate-200">
                                <thead class="bg-slate-50 text-xs text-slate-500 uppercase tracking-wider text-center">
                                    <tr>
                                        <th class="px-4 py-3 font-semibold border-r border-slate-200">Waktu Input</th>
                                        <th class="px-4 py-3 font-semibold border-r border-slate-200">Jenis Cuti</th>
                                        <th class="px-4 py-3 font-semibold border-r border-slate-200 w-1/4">Alasan Cuti</th>
                                        <th class="px-4 py-3 font-semibold border-r border-slate-200">Mulai Tanggal</th>
                                        <th class="px-4 py-3 font-semibold border-r border-slate-200">Sampai Dengan</th>
                                        <th class="px-4 py-3 font-semibold border-r border-slate-200">Durasi</th>
                                        <th class="px-4 py-3 font-semibold">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 bg-white">
                                    @forelse($riwayatCuti as $riwayat)
                                    <tr class="hover:bg-slate-50 transition-colors text-center">
                                        <!-- WAKTU INPUT DALAM WIB (Asia/Jakarta) -->
                                        <td class="px-4 py-3 border-r border-slate-100 whitespace-nowrap">
                                            <div class="text-[11px] text-slate-500">{{ \Carbon\Carbon::parse($riwayat->created_at)->timezone('Asia/Jakarta')->format('d M Y') }}</div>
                                            <div class="text-xs font-bold text-slate-700">{{ \Carbon\Carbon::parse($riwayat->created_at)->timezone('Asia/Jakarta')->format('H:i:s') }} WIB</div>
                                        </td>
                                        <td class="px-4 py-3 border-r border-slate-100">
                                            <span class="bg-slate-100 text-slate-700 px-2 py-1 rounded font-semibold text-xs">{{ $riwayat->jenis_cuti }}</span>
                                        </td>
                                        <td class="px-4 py-3 border-r border-slate-100 text-left text-slate-600">{{ $riwayat->alasan }}</td>
                                        <td class="px-4 py-3 border-r border-slate-100 text-slate-600">{{ \Carbon\Carbon::parse($riwayat->mulai_tanggal)->format('d M Y') }}</td>
                                        <td class="px-4 py-3 border-r border-slate-100 text-slate-600">{{ \Carbon\Carbon::parse($riwayat->sampai_tanggal)->format('d M Y') }}</td>
                                        <td class="px-4 py-3 font-bold text-blue-600 border-r border-slate-100">{{ $riwayat->durasi }} Hari</td>
                                        <td class="px-2 py-3">
                                            <form action="{{ route('cuti.destroy', $riwayat->id) }}" method="POST" class="m-0 p-0 inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="konfirmasiBatalkanCuti(this, '{{ $riwayat->jenis_cuti }}')" class="text-red-400 hover:text-red-600 bg-white hover:bg-red-50 p-1.5 rounded-lg transition-colors border border-transparent hover:border-red-200" title="Batalkan Cuti">
                                                    <svg class="w-4 h-4 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-8 text-center text-slate-400 font-medium bg-slate-50/50">
                                            Belum ada riwayat pengajuan cuti yang tercatat.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="px-8 py-4 border-t border-slate-100 bg-slate-50 rounded-b-2xl flex justify-end">
                    <button onclick="closeModal('modalDetailCuti_{{ $emp->id }}')" class="px-6 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded-lg text-sm font-semibold transition-colors">Tutup Detail</button>
                </div>
            </div>
        </div>
    @endforeach

    <!-- MODAL GLOBAL: ATUR HAK CUTI -->
    <div id="modalAturCuti" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
        <div class="modal-overlay absolute w-full h-full bg-slate-900 opacity-60 backdrop-blur-sm"></div>
        <div class="modal-container bg-white w-11/12 md:max-w-lg mx-auto rounded-2xl shadow-2xl z-50 overflow-y-auto">
            <form id="formAturCuti" method="POST" class="p-0">
                @csrf
                <div class="px-8 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50 rounded-t-2xl">
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">Atur Hak Cuti</h2>
                        <p class="text-xs text-slate-500 font-medium mt-0.5" id="atur_employee_name">Nama Pegawai</p>
                    </div>
                    <button type="button" onclick="closeModal('modalAturCuti')" class="text-slate-400 hover:text-slate-700 bg-white p-2 rounded-full border border-slate-200">✕</button>
                </div>
                <div class="px-8 py-6 space-y-4 text-sm">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Hak Cuti Tahun {{ $tahunBerjalan }} (N - Berjalan)</label>
                        <input type="number" name="hak_cuti_n" id="input_cuti_n" min="0" max="12" required class="w-full px-4 py-2 border rounded-xl font-bold text-blue-600 shadow-sm">
                        <p class="text-[11px] text-amber-600 mt-1">⚠️ Maksimal hak cuti tahunan adalah 12 hari.</p>
                    </div>
                    
                    <div id="wrapper_cuti_n1">
                        <label class="block font-semibold text-slate-700 mb-1">Sisa Cuti Tahun {{ $tahunBerjalan - 1 }} (N-1)</label>
                        <input type="number" name="sisa_cuti_n1" id="input_sisa_n1" min="0" max="10" required class="w-full px-4 py-2 border rounded-xl font-bold text-purple-600 shadow-sm">
                        <p class="text-[11px] text-amber-600 mt-1">⚠️ Maksimal sisa dari tahun {{ $tahunBerjalan - 1 }} yang dihitung adalah 6 hari.</p>
                    </div>
                    
                    <div id="wrapper_cuti_n2">
                        <label class="block font-semibold text-slate-700 mb-1">Sisa Cuti Tahun {{ $tahunBerjalan - 2 }} (N-2)</label>
                        <input type="number" name="sisa_cuti_n2" id="input_sisa_n2" min="0" max="10" required class="w-full px-4 py-2 border rounded-xl font-bold text-emerald-600 shadow-sm">
                        <p class="text-[11px] text-amber-600 mt-1">⚠️ Maksimal sisa dari tahun {{ $tahunBerjalan - 2 }} yang dihitung adalah 6 hari.</p>
                    </div>
                    
                    <!-- INPUT PIN OTORISASI UNTUK ATUR CUTI -->
<div class="pt-4 border-t border-slate-200 mt-4">
    <label class="block font-bold text-purple-700 mb-1 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg> PIN Otorisasi</label>
    
    <!-- TAMBAHKAN autocomplete="new-password" DI SINI -->
    <input type="password" name="pin" maxlength="6" autocomplete="new-password" value="" required class="w-full px-4 py-2.5 border border-purple-300 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none text-center tracking-widest font-mono text-lg shadow-sm" placeholder="••••••">
    
    <p class="text-[10px] text-slate-500 mt-1.5 text-center">Masukkan 6-Digit PIN Anda untuk menyimpan perubahan ini.</p>
</div>
                </div>
                <div class="px-8 py-4 bg-slate-50 flex justify-end gap-3 rounded-b-2xl">
                    <button type="button" onclick="closeModal('modalAturCuti')" class="px-5 py-2 bg-white border border-slate-300 rounded-xl font-semibold shadow-sm">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-xl font-semibold shadow-sm">Simpan Pengaturan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL GLOBAL: FORM INPUT CUTI -->
    <div id="modalInputCuti" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
        <div class="modal-overlay absolute w-full h-full bg-slate-900 opacity-60 backdrop-blur-sm"></div>
        <div class="modal-container bg-white w-11/12 md:max-w-5xl mx-auto rounded-2xl shadow-2xl z-50 overflow-y-auto max-h-[90vh]">
            <form action="{{ route('cuti.store') }}" method="POST" class="p-0">
                @csrf 
                <input type="hidden" name="employee_id" id="input_employee_id">
                
                <div class="px-8 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50 rounded-t-2xl">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800">Catat Pengajuan Cuti Baru</h2>
                        <p class="text-xs text-slate-500 mt-1">Isi formulir ini untuk mencatat riwayat dan mensimulasikan pemotongan hak cuti.</p>
                    </div>
                    <button type="button" onclick="closeModal('modalInputCuti')" class="text-slate-400 hover:text-slate-700 bg-white p-2 rounded-full shadow-sm border border-slate-200 transition-colors">✕</button>
                </div>

                <div class="px-8 py-6 space-y-6">
                    <div class="flex items-center justify-between p-4 bg-blue-50 border border-blue-100 rounded-xl shadow-sm">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-200 text-blue-700 rounded-full flex items-center justify-center font-bold text-lg shadow-inner">👤</div>
                            <div>
                                <p class="text-sm font-bold text-slate-800" id="display_employee_name">Nama Pegawai</p>
                                <p class="text-xs text-slate-500 mt-0.5">Total Sisa Hak Cuti: <span class="font-bold text-blue-700" id="display_sisa_cuti">12 Hari</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-800 mb-3">Jenis Cuti <span class="text-red-500">*</span></label>
                                <div class="grid grid-cols-2 gap-3">
                                    <label class="cursor-pointer relative">
                                        <input type="radio" name="jenis_cuti" value="Cuti Tahunan" class="radio-card-input sr-only" checked>
                                        <div class="radio-card-body flex items-center gap-2.5 p-3 border border-slate-200 rounded-xl transition-colors shadow-sm">
                                            <div class="radio-circle w-3.5 h-3.5 rounded-full border-2 flex-shrink-0"></div><span class="text-xs font-semibold">Cuti Tahunan</span>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer relative">
                                        <input type="radio" name="jenis_cuti" value="Cuti Besar" class="radio-card-input sr-only">
                                        <div class="radio-card-body flex items-center gap-2.5 p-3 border border-slate-200 rounded-xl transition-colors shadow-sm">
                                            <div class="radio-circle w-3.5 h-3.5 rounded-full border-2 flex-shrink-0"></div><span class="text-xs font-semibold">Cuti Besar</span>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer relative">
                                        <input type="radio" name="jenis_cuti" value="Cuti Sakit" class="radio-card-input sr-only">
                                        <div class="radio-card-body flex items-center gap-2.5 p-3 border border-slate-200 rounded-xl transition-colors shadow-sm">
                                            <div class="radio-circle w-3.5 h-3.5 rounded-full border-2 flex-shrink-0"></div><span class="text-xs font-semibold">Cuti Sakit</span>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer relative">
                                        <input type="radio" name="jenis_cuti" value="Cuti Melahirkan" class="radio-card-input sr-only">
                                        <div class="radio-card-body flex items-center gap-2.5 p-3 border border-slate-200 rounded-xl transition-colors shadow-sm">
                                            <div class="radio-circle w-3.5 h-3.5 rounded-full border-2 flex-shrink-0"></div><span class="text-xs font-semibold">Cuti Melahirkan</span>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer relative">
                                        <input type="radio" name="jenis_cuti" value="Alasan Penting" class="radio-card-input sr-only">
                                        <div class="radio-card-body flex items-center gap-2.5 p-3 border border-slate-200 rounded-xl transition-colors shadow-sm">
                                            <div class="radio-circle w-3.5 h-3.5 rounded-full border-2 flex-shrink-0"></div><span class="text-xs font-semibold">Alasan Penting</span>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer relative">
                                        <input type="radio" name="jenis_cuti" value="Luar Tanggungan" class="radio-card-input sr-only">
                                        <div class="radio-card-body flex items-center gap-2.5 p-3 border border-slate-200 rounded-xl transition-colors shadow-sm">
                                            <div class="radio-circle w-3.5 h-3.5 rounded-full border-2 flex-shrink-0"></div><span class="text-xs font-semibold">Luar Tanggungan</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            
                            <!-- OPSI KHUSUS CUTI TAHUNAN -->
                            <div id="wrapper_kategori_tahunan" class="mb-4">
                                <label class="block text-[11px] text-slate-500 mb-1.5 font-medium">Opsi Cuti Tahunan</label>
                                <div class="flex flex-wrap gap-2">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="kategori_tahunan" value="Keperluan Keluarga" class="peer sr-only">
                                        <div class="px-3 py-1.5 rounded-lg border border-slate-200 text-xs font-medium text-slate-600 peer-checked:bg-blue-50 peer-checked:text-blue-700 peer-checked:border-blue-500 transition-colors shadow-sm">Keperluan Keluarga</div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="kategori_tahunan" value="Istirahat" class="peer sr-only">
                                        <div class="px-3 py-1.5 rounded-lg border border-slate-200 text-xs font-medium text-slate-600 peer-checked:bg-blue-50 peer-checked:text-blue-700 peer-checked:border-blue-500 transition-colors shadow-sm">Istirahat</div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="kategori_tahunan" value="" class="peer sr-only" checked>
                                        <div class="px-3 py-1.5 rounded-lg border border-slate-200 text-xs font-medium text-slate-600 peer-checked:bg-blue-50 peer-checked:text-blue-700 peer-checked:border-blue-500 transition-colors shadow-sm">Lainnya</div>
                                    </label>
                                </div>
                            </div>
                            
                            <div>
                                <label id="label_alasan_cuti" class="block text-sm font-semibold text-slate-800 mb-2">Detail Alasan / Lainnya <span class="text-red-500">*</span></label>
                                <textarea id="input_alasan" name="alasan" rows="3" class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm shadow-sm transition-all" placeholder="Ketik alasan secara detail di sini..." required></textarea>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-800 mb-2">Waktu Pelaksanaan <span class="text-red-500">*</span></label>
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-[11px] text-slate-500 mb-1.5 font-medium">Mulai Tanggal</label>
                                        <input type="text" id="mulai_tanggal" name="mulai_tanggal" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm bg-white cursor-pointer shadow-sm" placeholder="Pilih kalender..." required>
                                    </div>
                                    <div>
                                        <label class="block text-[11px] text-slate-500 mb-1.5 font-medium">Sampai Dengan (s/d)</label>
                                        <input type="text" id="sampai_tanggal" name="sampai_tanggal" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm bg-white cursor-pointer shadow-sm" placeholder="Pilih kalender..." required>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-[11px] text-slate-500 mb-1.5 font-medium">Total Durasi (Otomatis)</label>
                                    <div class="relative">
                                        <input type="number" id="durasi_input" name="durasi" min="1" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm pr-12 font-bold shadow-sm bg-slate-50" placeholder="0" required readonly>
                                        <span class="absolute right-4 top-2.5 text-sm font-medium text-slate-400 pointer-events-none">Hari</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="font-bold text-slate-800 text-sm mb-3">V. SISA HAK CUTI (SIMULASI TAHUNAN)</h3>
                                <div class="border border-slate-200 rounded-xl overflow-hidden shadow-sm">
                                    <table class="table-formal text-sm w-full">
                                        <thead class="bg-slate-50 font-bold uppercase text-center">
                                            <tr>
                                                <th rowspan="2">Tahun</th>
                                                <th colspan="2">Sisa</th>
                                                <th rowspan="2">Keterangan</th>
                                            </tr>
                                            <tr>
                                                <th>Semula</th>
                                                <th>Menjadi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center font-bold text-base">
                                            <tr class="sim-row-n2">
                                                <td>N-2</td>
                                                <td id="sim_semula_n2">0</td>
                                                <td id="sim_menjadi_n2">0</td>
                                                <td class="text-sm font-medium">{{ $tahunBerjalan - 2 }}</td>
                                            </tr>
                                            <tr class="sim-row-n1">
                                                <td>N-1</td>
                                                <td id="sim_semula_n1">0</td>
                                                <td id="sim_menjadi_n1">0</td>
                                                <td class="text-sm font-medium">{{ $tahunBerjalan - 1 }}</td>
                                            </tr>
                                            <tr class="sim-row-n">
                                                <td>N</td>
                                                <td id="sim_semula_n">12</td>
                                                <td id="sim_menjadi_n">12</td>
                                                <td class="text-sm font-medium">{{ $tahunBerjalan }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="px-8 py-5 border-t border-slate-100 bg-slate-50 flex justify-end gap-4 rounded-b-2xl">
                    <button type="button" onclick="closeModal('modalInputCuti')" class="px-6 py-2.5 bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 rounded-xl text-sm font-semibold shadow-sm transition-colors">Batal</button>
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-semibold shadow-sm transition-colors">Simpan Data Cuti</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL TAMBAH PEGAWAI DENGAN PINTASAN JABATAN -->
    <div id="modalTambahPegawai" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
        <div class="modal-overlay absolute w-full h-full bg-slate-900 opacity-60 backdrop-blur-sm"></div>
        <div class="modal-container bg-white w-11/12 md:max-w-2xl mx-auto rounded-2xl shadow-2xl z-50 overflow-y-auto max-h-[90vh]">
            <form action="{{ route('pegawai.store') }}" method="POST" class="p-0">
                @csrf
                <div class="px-8 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50 rounded-t-2xl">
                    <h2 class="text-xl font-bold text-slate-800">Tambah Data Pegawai</h2>
                    <button type="button" onclick="closeModal('modalTambahPegawai')" class="text-slate-400 hover:text-slate-700 bg-white p-2 rounded-full shadow-sm border border-slate-200">✕</button>
                </div>
                <div class="px-8 py-8 space-y-6 text-sm">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label class="block font-semibold text-slate-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none shadow-sm">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-2">NIP / NRP / NI PPPK</label>
                            <input type="text" name="nip_nrp" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none shadow-sm">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-2">Status Kepegawaian <span class="text-red-500">*</span></label>
                            <select name="status" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none bg-white shadow-sm">
                                <option value="PNS">PNS</option>
                                <option value="PPPK">PPPK</option>
                                <option value="TNI">TNI</option>
                                <option value="POLRI">POLRI</option>
                                <option value="PPPK_PARUH_WAKTU">PPPK PARUH WAKTU</option>
                                <option value="OUTSOURCING">OUTSOURCING</option>
                            </select>
                        </div>
                        
                        <div class="col-span-2">
                            <label class="block font-semibold text-slate-700 mb-2">Jabatan</label>
                            
                            <div class="flex flex-wrap gap-2 mb-2">
                                @if(isset($hasKepala) && $hasKepala)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-medium bg-slate-100 text-slate-400 border border-slate-200 cursor-not-allowed" title="Jabatan Kepala BNN sudah terisi">
                                        🔒 KEPALA BNN KAB. MALANG
                                    </span>
                                @else
                                    <button type="button" onclick="document.getElementById('input_jabatan').value='KEPALA BNN KAB. MALANG'; document.getElementById('input_jabatan').readOnly=true;" class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-medium bg-blue-50 text-blue-700 border border-blue-200 hover:bg-blue-100 transition-colors">
                                        + KEPALA BNN KAB. MALANG
                                    </button>
                                @endif

                                @if(isset($hasKasubbag) && $hasKasubbag)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-medium bg-slate-100 text-slate-400 border border-slate-200 cursor-not-allowed" title="Jabatan Kasubbag Umum sudah terisi">
                                        🔒 KASUBBAG UMUM BNN KAB. MALANG
                                    </span>
                                @else
                                    <button type="button" onclick="document.getElementById('input_jabatan').value='KASUBBAG UMUM BNN KAB. MALANG'; document.getElementById('input_jabatan').readOnly=true;" class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-medium bg-purple-50 text-purple-700 border border-purple-200 hover:bg-purple-100 transition-colors">
                                        + KASUBBAG UMUM BNN KAB. MALANG
                                    </button>
                                @endif
                                
                                <button type="button" onclick="document.getElementById('input_jabatan').value=''; document.getElementById('input_jabatan').readOnly=false;" class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-medium bg-white text-slate-600 border border-slate-300 hover:bg-slate-50 transition-colors">
                                    🔄 Ketik Manual
                                </button>
                            </div>

                            <input type="text" name="jabatan" id="input_jabatan" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none shadow-sm transition-all" placeholder="Pilih opsi di atas atau ketik manual...">
                        </div>

                        <div>
                            <label class="block font-semibold text-slate-700 mb-2">Pangkat</label>
                            <input type="text" name="pangkat" placeholder="Contoh: Penata Muda" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none shadow-sm">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-2">Golongan</label>
                            <input type="text" name="golongan" placeholder="Contoh: III-a" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none shadow-sm">
                        </div>
                    </div>
                </div>
                <div class="px-8 py-5 border-t border-slate-100 bg-slate-50 flex justify-end gap-4 rounded-b-2xl">
                    <button type="button" onclick="closeModal('modalTambahPegawai')" class="px-6 py-2.5 bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 rounded-xl text-sm font-semibold transition-colors shadow-sm">Batal</button>
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-semibold transition-colors shadow-sm">Simpan Pegawai</button>
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
            
            // KODE TAMBAHAN: Paksa kolom PIN menjadi kosong saat modal dibuka
            const pinInput = document.querySelector('#modalAturCuti input[name="pin"]');
            if(pinInput) pinInput.value = '';
            
            document.getElementById('formAturCuti').action = `/pegawai/${id}/saldo`;
            openModal('modalAturCuti');
        }

        function openModalInputCuti(id, nama, status, sisaTotal, vN, vN1, vN2) {
            document.getElementById('input_employee_id').value = id;
            document.getElementById('display_employee_name').innerText = nama;
            document.getElementById('display_sisa_cuti').innerText = sisaTotal + ' Hari';
            
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
            document.getElementById('label_alasan_cuti').innerHTML = 'Detail Alasan / Lainnya <span class="text-red-500">*</span>';
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
                const labelAlasan = document.getElementById('label_alasan_cuti');
                
                if (e.target.value === 'Cuti Tahunan') {
                    wrapperKategori.style.display = 'block';
                    labelAlasan.innerHTML = 'Detail Alasan / Lainnya <span class="text-red-500">*</span>';
                } else {
                    wrapperKategori.style.display = 'none';
                    labelAlasan.innerHTML = 'Alasan Cuti <span class="text-red-500">*</span>';
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

            document.getElementById('sim_menjadi_n2').className = (sN2 < saldoN2) ? 'font-bold text-red-600' : 'font-bold text-slate-800';
            document.getElementById('sim_menjadi_n1').className = (sN1 < saldoN1) ? 'font-bold text-red-600' : 'font-bold text-slate-800';
            document.getElementById('sim_menjadi_n').className = (sN < saldoN) ? 'font-bold text-red-600' : 'font-bold text-slate-800';
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
            if(clockEl) {
                clockEl.innerText = dateStr + ' - ' + timeStr + ' WIB';
            }
        }
        setInterval(updateRealtimeClock, 1000);
        updateRealtimeClock(); 

        // FUNGSI SWEETALERT UNTUK MEMINTA PIN SAAT MENGHAPUS PEGAWAI
        // FUNGSI SWEETALERT UNTUK MEMINTA PIN SAAT MENGHAPUS PEGAWAI
        function konfirmasiHapusPegawai(btn, nama) {
            Swal.fire({
                title: 'Otorisasi Diperlukan',
                html: `Masukkan <b>PIN 6-Digit</b> Anda untuk menghapus data <b>${nama}</b> secara permanen.`,
                input: 'password',
                inputAttributes: {
                    maxlength: 6,
                    autocapitalize: 'off',
                    autocorrect: 'off',
                    autocomplete: 'new-password', /* INI KUNCI UNTUK MENCEGAH AUTO-FILL */
                    style: 'text-align: center; letter-spacing: 0.5em; font-family: monospace; font-size: 1.25rem;'
                },
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Verifikasi & Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                preConfirm: (pin) => {
                    if (!pin) { Swal.showValidationMessage('PIN tidak boleh kosong!'); }
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
                    // Membersihkan search bar jika user membatalkan modal
                    document.getElementById("searchPegawai").value = "";
                    filterPegawai();
                }
            });
        }

        function konfirmasiBatalkanCuti(btn, jenisCuti) {
            let textTambahan = jenisCuti === 'Cuti Tahunan' ? '<br><span class="text-emerald-600 font-semibold mt-2 block">Saldo hak cuti tahunan akan dikembalikan otomatis.</span>' : '';
            Swal.fire({
                title: 'Batalkan Cuti?',
                html: `Apakah Anda yakin ingin membatalkan pengajuan <b>${jenisCuti}</b> ini?${textTambahan}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Batalkan!',
                cancelButtonText: 'Kembali',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.closest('form').submit();
                }
            });
        }

        function openModal(id) { document.getElementById(id).classList.remove('opacity-0', 'pointer-events-none'); }
        function closeModal(id) { document.getElementById(id).classList.add('opacity-0', 'pointer-events-none'); }
        window.onclick = function(e) { if (e.target.classList.contains('modal-overlay')) e.target.parentElement.classList.add('opacity-0', 'pointer-events-none'); }
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