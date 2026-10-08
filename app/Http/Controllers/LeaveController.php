<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveBalance;
use App\Models\LeaveHistory;
use Illuminate\Http\Request;
use App\Models\User;

class LeaveController extends Controller
{
    public function index()
    {
        $employees = Employee::orderByRaw("
            CASE 
                WHEN jabatan = 'KEPALA BNN KAB. MALANG' THEN 1
                WHEN jabatan = 'KASUBBAG UMUM BNN KAB. MALANG' THEN 2
                ELSE 3
            END ASC,
            CASE 
                WHEN golongan LIKE 'IV-%' THEN 1
                WHEN golongan LIKE 'III-%' THEN 2
                WHEN golongan LIKE 'II-%' THEN 3
                WHEN golongan LIKE 'I-%' THEN 4
                ELSE 5
            END ASC, 
            golongan DESC
        ")->get();

        // OTOMATIS MENGIKUTI TAHUN SERVER/KALENDER SAAT INI
        $tahunBerjalan = (int) date('Y');

        $hasKepala = Employee::where('jabatan', 'KEPALA BNN KAB. MALANG')->exists();
        $hasKasubbag = Employee::where('jabatan', 'KASUBBAG UMUM BNN KAB. MALANG')->exists();

        return view('cuti.dashboard', compact('employees', 'tahunBerjalan', 'hasKepala', 'hasKasubbag'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip_nrp' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'pangkat' => 'nullable|string|max:255',
            'golongan' => 'nullable|string|max:255',
            'status' => 'required|in:PNS,TNI,POLRI,PPPK,PPPK_PARUH_WAKTU,OUTSOURCING',
            'tanggal_mulai_kerja' => 'nullable|date', // Hanya ini yang dibutuhkan untuk profil
        ]);

        if (!empty($validated['jabatan'])) {
            $jabatanInput = strtoupper(trim($validated['jabatan']));

            if ($jabatanInput === 'KEPALA BNN KAB. MALANG') {
                if (Employee::where('jabatan', 'KEPALA BNN KAB. MALANG')->exists()) {
                    return back()->withInput()->with('error', 'Gagal! Jabatan KEPALA BNN KAB. MALANG sudah terisi.');
                }
            }

            if ($jabatanInput === 'KASUBBAG UMUM BNN KAB. MALANG') {
                if (Employee::where('jabatan', 'KASUBBAG UMUM BNN KAB. MALANG')->exists()) {
                    return back()->withInput()->with('error', 'Gagal! Jabatan KASUBBAG UMUM BNN KAB. MALANG sudah terisi.');
                }
            }
        }

        $pegawai = Employee::create($validated);

        // KODE BARU: SELALU PAKAI NAMA DEPAN UNTUK USERNAME
        $pecahNama = explode(' ', trim($pegawai->nama));
        $baseUsername = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $pecahNama[0]));
        if (empty($baseUsername))
            $baseUsername = 'pegawai';

        $usernameBaru = $baseUsername;
        $counter = 1;

        while (User::where('username', $usernameBaru)->exists()) {
            $usernameBaru = $baseUsername . $counter;
            $counter++;
        }

        User::create([
            'role' => 'pegawai',
            'employee_id' => $pegawai->id,
            'name' => $pegawai->nama,
            'username' => $usernameBaru,
            'email' => $usernameBaru . '_' . $pegawai->id . '@bnn.go.id',
            'password' => bcrypt('bnnkmalang'),
        ]);

        return back()
            ->with('success', 'Data pegawai berhasil ditambahkan! Silakan atur Hak Cuti awalnya.')
            ->with('new_employee_id', $pegawai->id)
            ->with('new_employee_nama', $pegawai->nama)
            ->with('new_employee_status', $pegawai->status)
            ->with('new_username', $usernameBaru);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        // 1. Validasi inputan baru (termasuk username & password)
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip_nrp' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'pangkat' => 'nullable|string|max:255',
            'golongan' => 'nullable|string|max:255',
            'status' => 'required|in:PNS,TNI,POLRI,PPPK,PPPK_PARUH_WAKTU,OUTSOURCING',
            'tanggal_mulai_kerja' => 'nullable|date',
            // Username wajib diisi, tidak boleh kembar dengan orang lain
            'username' => 'required|string|max:255|unique:users,username,' . ($employee->user ? $employee->user->id : ''),
            // Password boleh kosong, diisi hanya jika admin ingin mengubahnya
            'password' => 'nullable|string|min:5',
        ]);

        // Cek Jabatan Ganda
        if (!empty($request->jabatan)) {
            $jabatanInput = strtoupper(trim($request->jabatan));

            if ($jabatanInput === 'KEPALA BNN KAB. MALANG' && strtoupper(trim($employee->jabatan)) !== 'KEPALA BNN KAB. MALANG') {
                if (Employee::where('jabatan', 'KEPALA BNN KAB. MALANG')->exists()) {
                    return back()->withInput()->with('error', 'Gagal update! Jabatan KEPALA BNN KAB. MALANG sudah terisi.');
                }
            }

            if ($jabatanInput === 'KASUBBAG UMUM BNN KAB. MALANG' && strtoupper(trim($employee->jabatan)) !== 'KASUBBAG UMUM BNN KAB. MALANG') {
                if (Employee::where('jabatan', 'KASUBBAG UMUM BNN KAB. MALANG')->exists()) {
                    return back()->withInput()->with('error', 'Gagal update! Jabatan KASUBBAG UMUM BNN KAB. MALANG sudah terisi.');
                }
            }
        }

        // 2. Update Data Profil Pegawai
        $employee->update($request->only([
            'nama',
            'nip_nrp',
            'jabatan',
            'pangkat',
            'golongan',
            'status',
            'tanggal_mulai_kerja'
        ]));

        // 3. Update Akses Login Pegawai (Jika akun sudah terhubung)
        if ($employee->user) {
            $userData = [
                // Paksa huruf kecil dan buang spasi agar aman saat diketik
                'username' => strtolower(str_replace(' ', '', $request->username))
            ];

            // Jika form password diisi oleh Admin, enkripsi dan perbarui
            if ($request->filled('password')) {
                $userData['password'] = bcrypt($request->password);
            }

            $employee->user->update($userData);
        }

        return back()->with('success', 'Profil dan Akses Login pegawai berhasil diperbarui!');
    }

    public function destroy(Request $request, $id)
    {
        $user = auth()->user();

        if (!$user->pin_hapus) {
            return back()->with('error', 'Akses Ditolak! Anda belum mengatur PIN Hapus Pegawai. Silakan atur di menu Profil.');
        }

        if (!\Illuminate\Support\Facades\Hash::check($request->pin, $user->pin_hapus)) {
            return back()->with('error', 'Otorisasi Gagal! PIN yang Anda masukkan salah.');
        }

        $employee = Employee::findOrFail($id);

        // Hapus akun login agar username-nya bisa didaur ulang
        if ($employee->user) {
            $employee->user->delete();
        }

        $employee->delete();
        return back()->with('success', 'Data pegawai, riwayat cuti, dan akun login berhasil dihapus!');
    }

    public function updateSaldo(Request $request, $id)
    {
        $request->validate([
            'hak_cuti_n' => 'required|integer|min:0|max:12',
            'sisa_cuti_n1' => 'required|integer|min:0|max:10',
            'sisa_cuti_n2' => 'required|integer|min:0|max:10',
            'pin' => 'required',
        ]);

        $user = auth()->user();
        if (!$user->pin_cuti) {
            return back()->with('error', 'Akses Ditolak! Anda belum mengatur PIN Atur Hak Cuti di menu Profil.');
        }
        if (!\Illuminate\Support\Facades\Hash::check($request->pin, $user->pin_cuti)) {
            return back()->with('error', 'Otorisasi Gagal! PIN Konfirmasi salah.');
        }

        $tahunBerjalan = (int) date('Y');
        $tahunN1 = $tahunBerjalan - 1;
        $tahunN2 = $tahunBerjalan - 2;

        $bawaanN1 = min($request->sisa_cuti_n1, 6);
        $bawaanN2 = min($request->sisa_cuti_n2, 6);

        LeaveBalance::updateOrCreate(
            ['employee_id' => $id, 'tahun' => $tahunN2],
            ['hak_cuti_dasar' => $bawaanN2, 'sisa_cuti_bawaan' => 0, 'sisa_cuti_total' => $bawaanN2]
        );

        LeaveBalance::updateOrCreate(
            ['employee_id' => $id, 'tahun' => $tahunN1],
            ['hak_cuti_dasar' => $bawaanN1, 'sisa_cuti_bawaan' => 0, 'sisa_cuti_total' => $bawaanN1]
        );

        LeaveBalance::updateOrCreate(
            ['employee_id' => $id, 'tahun' => $tahunBerjalan],
            ['hak_cuti_dasar' => $request->hak_cuti_n, 'sisa_cuti_bawaan' => 0, 'sisa_cuti_total' => $request->hak_cuti_n]
        );

        return back()->with('success', 'Pengaturan hak cuti multi-tahun berhasil diperbarui!');
    }

    public function storeCuti(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'jenis_cuti' => 'required',
            'kategori_tahunan' => 'nullable|string',
            'alasan' => 'required|string',
            'mulai_tanggal' => 'required|date',
            'sampai_tanggal' => 'required|date',
            'durasi' => 'required|integer|min:1',
            'tanggal_surat' => 'required|date', // Validasi tanggal_surat dipindah ke sini
            'telepon' => 'required|string|max:50',
        ]);

        $tahunBerjalan = (int) date('Y');
        $tahunN1 = $tahunBerjalan - 1;
        $tahunN2 = $tahunBerjalan - 2;

        $durasiCuti = $request->durasi;
        $jenisCuti = $request->jenis_cuti;

        $alasanFinal = $request->alasan;
        if ($jenisCuti === 'Cuti Tahunan' && !empty($request->kategori_tahunan)) {
            $alasanFinal = $request->kategori_tahunan . ' - ' . $request->alasan;
        }

        if ($jenisCuti === 'Cuti Tahunan') {
            $bN = LeaveBalance::where('employee_id', $request->employee_id)->where('tahun', $tahunBerjalan)->first();
            $bN1 = LeaveBalance::where('employee_id', $request->employee_id)->where('tahun', $tahunN1)->first();
            $bN2 = LeaveBalance::where('employee_id', $request->employee_id)->where('tahun', $tahunN2)->first();

            $sN = $bN ? $bN->sisa_cuti_total : 12;
            $sN1 = $bN1 ? $bN1->sisa_cuti_total : 0;
            $sN2 = $bN2 ? $bN2->sisa_cuti_total : 0;

            $totalSisaAktif = $sN + $sN1 + $sN2;

            if ($totalSisaAktif < $durasiCuti) {
                return back()->with('error', 'Gagal! Durasi cuti (' . $durasiCuti . ' hari) melebihi total sisa hak cuti tahunan (' . $totalSisaAktif . ' hari).');
            }

            $sisaPengurangan = $durasiCuti;

            if ($bN2 && $bN2->sisa_cuti_total > 0) {
                $potong = min($bN2->sisa_cuti_total, $sisaPengurangan);
                $bN2->sisa_cuti_total -= $potong;
                $bN2->save();
                $sisaPengurangan -= $potong;
            }

            if ($sisaPengurangan > 0 && $bN1 && $bN1->sisa_cuti_total > 0) {
                $potong = min($bN1->sisa_cuti_total, $sisaPengurangan);
                $bN1->sisa_cuti_total -= $potong;
                $bN1->save();
                $sisaPengurangan -= $potong;
            }

            if ($sisaPengurangan > 0) {
                if ($bN) {
                    $bN->sisa_cuti_total -= $sisaPengurangan;
                    $bN->save();
                } else {
                    LeaveBalance::create([
                        'employee_id' => $request->employee_id,
                        'tahun' => $tahunBerjalan,
                        'hak_cuti_dasar' => 12,
                        'sisa_cuti_total' => 12 - $sisaPengurangan
                    ]);
                }
            }
        }

        LeaveHistory::create([
            'employee_id' => $request->employee_id,
            'jenis_cuti' => $request->jenis_cuti,
            'alasan' => $alasanFinal,
            'mulai_tanggal' => $request->mulai_tanggal,
            'sampai_tanggal' => $request->sampai_tanggal,
            'durasi' => $durasiCuti,
            'tahun' => $tahunBerjalan,
            'tanggal_surat' => $request->tanggal_surat,
            'telepon' => $request->telepon,
        ]);

        $pesanNotifikasi = ($jenisCuti === 'Cuti Tahunan')
            ? 'Pengajuan Cuti Tahunan dicatat dan hak cuti otomatis terpotong.'
            : 'Pengajuan ' . $jenisCuti . ' dicatat ke riwayat (Hak Cuti Tahunan tidak dikurangi).';

        return back()->with('success', $pesanNotifikasi);
    }

    public function destroyCuti($id)
    {
        $history = LeaveHistory::findOrFail($id);
        $jenisCuti = $history->jenis_cuti;
        $refundHari = $history->durasi;
        $employeeId = $history->employee_id;
        $tahunBerjalan = $history->tahun;
        $tahunN1 = $tahunBerjalan - 1;
        $tahunN2 = $tahunBerjalan - 2;

        if ($jenisCuti === 'Cuti Tahunan') {
            $bN = LeaveBalance::where('employee_id', $employeeId)->where('tahun', $tahunBerjalan)->first();
            $bN1 = LeaveBalance::where('employee_id', $employeeId)->where('tahun', $tahunN1)->first();
            $bN2 = LeaveBalance::where('employee_id', $employeeId)->where('tahun', $tahunN2)->first();

            if ($bN && $refundHari > 0) {
                $space = $bN->hak_cuti_dasar - $bN->sisa_cuti_total;
                if ($space > 0) {
                    $add = min($space, $refundHari);
                    $bN->sisa_cuti_total += $add;
                    $bN->save();
                    $refundHari -= $add;
                }
            }
            if ($bN1 && $refundHari > 0) {
                $space = $bN1->hak_cuti_dasar - $bN1->sisa_cuti_total;
                if ($space > 0) {
                    $add = min($space, $refundHari);
                    $bN1->sisa_cuti_total += $add;
                    $bN1->save();
                    $refundHari -= $add;
                }
            }
            if ($bN2 && $refundHari > 0) {
                $space = $bN2->hak_cuti_dasar - $bN2->sisa_cuti_total;
                if ($space > 0) {
                    $add = min($space, $refundHari);
                    $bN2->sisa_cuti_total += $add;
                    $bN2->save();
                    $refundHari -= $add;
                }
            }
        }

        $history->delete();

        $pesan = ($jenisCuti === 'Cuti Tahunan')
            ? 'Riwayat dibatalkan dan saldo Hak Cuti Tahunan telah dikembalikan.'
            : 'Riwayat ' . $jenisCuti . ' berhasil dihapus.';

        return back()->with('success', $pesan);
    }

    // --- DASHBOARD KHUSUS PEGAWAI ---
    public function dashboardPegawai()
    {
        $user = auth()->user();
        $pegawai = $user->employee;
        $tahunBerjalan = (int) date('Y');

        if (!$pegawai) {
            return redirect('/')->with('error', 'Data kepegawaian Anda belum terhubung.');
        }

        $bN = $pegawai->leaveBalances()->where('tahun', $tahunBerjalan)->first();
        $bN1 = $pegawai->leaveBalances()->where('tahun', $tahunBerjalan - 1)->first();
        $bN2 = $pegawai->leaveBalances()->where('tahun', $tahunBerjalan - 2)->first();

        $valN = $bN ? $bN->sisa_cuti_total : 12;
        $valN1 = $bN1 ? $bN1->sisa_cuti_total : 0;
        $valN2 = $bN2 ? $bN2->sisa_cuti_total : 0;
        $sisaHari = $valN + min($valN1, 6) + min($valN2, 6);

        $riwayatCuti = $pegawai->leaveHistories()->where('tahun', $tahunBerjalan)->orderBy('created_at', 'desc')->get();

        return view('pegawai.dashboard', compact('pegawai', 'tahunBerjalan', 'sisaHari', 'riwayatCuti', 'valN', 'valN1', 'valN2'));
    }

    // --- GENERATE SURAT WORD ---
    // --- GENERATE SURAT WORD ---
    public function cetakSurat($id)
    {
        $riwayat = LeaveHistory::findOrFail($id);
        $pegawai = $riwayat->employee;

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/templates/template_cuti.docx'));

        // 1. OLAHAN TANGGAL & ROMAWI
        $tglSurat = \Carbon\Carbon::parse($riwayat->tanggal_surat ?? $riwayat->created_at)->timezone('Asia/Jakarta')->locale('id');
        $romawiBulan = ['1' => 'I', '2' => 'II', '3' => 'III', '4' => 'IV', '5' => 'V', '6' => 'VI', '7' => 'VII', '8' => 'VIII', '9' => 'IX', '10' => 'X', '11' => 'XI', '12' => 'XII'];

        $templateProcessor->setValue('tgl_surat', $tglSurat->translatedFormat('j F Y'));
        $templateProcessor->setValue('romawi', $romawiBulan[$tglSurat->format('n')]);
        $templateProcessor->setValue('tahun_surat', $tglSurat->format('Y'));

        // 2. DATA PEGAWAI & MASA KERJA OTOMATIS
        $templateProcessor->setValue('nama', $pegawai->nama);
        $templateProcessor->setValue('nip', $pegawai->nip_nrp);
        $templateProcessor->setValue('jabatan', $pegawai->jabatan);
        $templateProcessor->setValue('masa_kerja', $pegawai->masa_kerja);
        $templateProcessor->setValue('telepon', $riwayat->telepon ?? '-');

        // --- TAMBAHAN BARU: TELEPON & PEJABAT ---
        $templateProcessor->setValue('telepon', $riwayat->telepon ?? '-');

        // Tarik data pejabat secara otomatis dari database
        $kepala = Employee::where('jabatan', 'KEPALA BNN KAB. MALANG')->first();
        $kasubbag = Employee::where('jabatan', 'KASUBBAG UMUM BNN KAB. MALANG')->first();

        // Masukkan ke template (Jika belum ada pejabatnya, beri titik-titik)
        $templateProcessor->setValue('nama_kepala', $kepala ? $kepala->nama : '.......................................');
        $templateProcessor->setValue('nip_kepala', $kepala ? $kepala->nip_nrp : '.......................');

        $templateProcessor->setValue('nama_kasubbag', $kasubbag ? $kasubbag->nama : '.......................................');
        $templateProcessor->setValue('nip_kasubbag', $kasubbag ? $kasubbag->nip_nrp : '.......................');

        // 3. LOGIKA CENTANG (√) JENIS CUTI
        $jenis = $riwayat->jenis_cuti;
        $templateProcessor->setValue('c_thn', $jenis == 'Cuti Tahunan' ? '√' : '');
        $templateProcessor->setValue('c_bsr', $jenis == 'Cuti Besar' ? '√' : '');
        $templateProcessor->setValue('c_skt', $jenis == 'Cuti Sakit' ? '√' : '');
        $templateProcessor->setValue('c_mlh', $jenis == 'Cuti Melahirkan' ? '√' : '');
        $templateProcessor->setValue('c_ptg', $jenis == 'Alasan Penting' ? '√' : '');
        $templateProcessor->setValue('c_ltn', $jenis == 'Luar Tanggungan' ? '√' : '');

        // 4. DETAIL CUTI (ALASAN & WAKTU)
        $templateProcessor->setValue('alasan', $riwayat->alasan);
        $templateProcessor->setValue('durasi', $riwayat->durasi);
        $templateProcessor->setValue('mulai', \Carbon\Carbon::parse($riwayat->mulai_tanggal)->locale('id')->translatedFormat('j F Y'));
        $templateProcessor->setValue('sampai', \Carbon\Carbon::parse($riwayat->sampai_tanggal)->locale('id')->translatedFormat('j F Y'));

        // 5. LOGIKA SIMULASI SALDO CUTI (TABEL V)
        $tahunBerjalan = $riwayat->tahun;

        $bN = LeaveBalance::where('employee_id', $pegawai->id)->where('tahun', $tahunBerjalan)->first();
        $bN1 = LeaveBalance::where('employee_id', $pegawai->id)->where('tahun', $tahunBerjalan - 1)->first();
        $bN2 = LeaveBalance::where('employee_id', $pegawai->id)->where('tahun', $tahunBerjalan - 2)->first();

        // Ambil Hak Dasar (Untuk Limit Maksimal)
        $hakN = $bN ? $bN->hak_cuti_dasar : 12;
        $hakN1 = $bN1 ? $bN1->hak_cuti_dasar : 0;
        $hakN2 = $bN2 ? $bN2->hak_cuti_dasar : 0;

        // Saldo Saat Ini (Menjadi)
        $mj_n = $bN ? $bN->sisa_cuti_total : 12;
        $mj_n1 = $bN1 ? $bN1->sisa_cuti_total : 0;
        $mj_n2 = $bN2 ? $bN2->sisa_cuti_total : 0;

        // Saldo Semula (Default sama dengan Menjadi jika bukan Cuti Tahunan)
        $sm_n = $mj_n;
        $sm_n1 = $mj_n1;
        $sm_n2 = $mj_n2;

        // Jika Cuti Tahunan, hitung mundur (tambahkan durasi kembali ke saldo) untuk dapatkan 'Semula'
        if ($jenis === 'Cuti Tahunan') {
            $refundHari = $riwayat->durasi;

            // Kembalikan ke N terlebih dahulu (karena pemotongan terakhir ada di N)
            if ($sm_n < $hakN && $refundHari > 0) {
                $add = min($hakN - $sm_n, $refundHari);
                $sm_n += $add;
                $refundHari -= $add;
            }
            // Kembalikan ke N-1
            if ($sm_n1 < $hakN1 && $refundHari > 0) {
                $add = min($hakN1 - $sm_n1, $refundHari);
                $sm_n1 += $add;
                $refundHari -= $add;
            }
            // Kembalikan ke N-2
            if ($sm_n2 < $hakN2 && $refundHari > 0) {
                $add = min($hakN2 - $sm_n2, $refundHari);
                $sm_n2 += $add;
                $refundHari -= $add;
            }
        }

        // Terapkan ke File Word
        $templateProcessor->setValue('sm_n2', $sm_n2);
        $templateProcessor->setValue('mj_n2', $mj_n2);
        $templateProcessor->setValue('ket_n2', $tahunBerjalan - 2);

        $templateProcessor->setValue('sm_n1', $sm_n1);
        $templateProcessor->setValue('mj_n1', $mj_n1);
        $templateProcessor->setValue('ket_n1', $tahunBerjalan - 1);

        $templateProcessor->setValue('sm_n', $sm_n);
        $templateProcessor->setValue('mj_n', $mj_n);
        $templateProcessor->setValue('ket_n', $tahunBerjalan);

        // Simpan & Download
        $fileName = 'Surat_Cuti_' . str_replace(' ', '_', $pegawai->nama) . '.docx';
        $tempPath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($tempPath);

        return response()->download($tempPath)->deleteFileAfterSend(true);
    }

    // --- KONFIRMASI CUTI (OLEH ADMIN) ---
    public function konfirmasiCuti(Request $request, $id)
    {
        $history = LeaveHistory::findOrFail($id);
        $statusBaru = $request->status;

        if ($statusBaru === 'Ditolak' && $history->jenis_cuti === 'Cuti Tahunan' && $history->status_pengajuan !== 'Ditolak') {
            $employeeId = $history->employee_id;
            $refundHari = $history->durasi;
            $tahunBerjalan = $history->tahun;

            $bN = LeaveBalance::where('employee_id', $employeeId)->where('tahun', $tahunBerjalan)->first();
            $bN1 = LeaveBalance::where('employee_id', $employeeId)->where('tahun', $tahunBerjalan - 1)->first();
            $bN2 = LeaveBalance::where('employee_id', $employeeId)->where('tahun', $tahunBerjalan - 2)->first();

            if ($bN && $refundHari > 0) {
                $space = $bN->hak_cuti_dasar - $bN->sisa_cuti_total;
                if ($space > 0) {
                    $add = min($space, $refundHari);
                    $bN->sisa_cuti_total += $add;
                    $bN->save();
                    $refundHari -= $add;
                }
            }
            if ($bN1 && $refundHari > 0) {
                $space = $bN1->hak_cuti_dasar - $bN1->sisa_cuti_total;
                if ($space > 0) {
                    $add = min($space, $refundHari);
                    $bN1->sisa_cuti_total += $add;
                    $bN1->save();
                    $refundHari -= $add;
                }
            }
            if ($bN2 && $refundHari > 0) {
                $space = $bN2->hak_cuti_dasar - $bN2->sisa_cuti_total;
                if ($space > 0) {
                    $add = min($space, $refundHari);
                    $bN2->sisa_cuti_total += $add;
                    $bN2->save();
                }
            }
        }

        $history->status_pengajuan = $statusBaru;
        $history->save();

        return back()->with('success', 'Status pengajuan cuti berhasil diperbarui menjadi: ' . $statusBaru);
    }
}