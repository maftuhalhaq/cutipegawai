<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveBalance;
use App\Models\LeaveHistory;
use Illuminate\Http\Request;

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

        return back()
            ->with('success', 'Data pegawai berhasil ditambahkan! Silakan atur Hak Cuti awalnya.')
            ->with('new_employee_id', $pegawai->id)
            ->with('new_employee_nama', $pegawai->nama)
            ->with('new_employee_status', $pegawai->status);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip_nrp' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'pangkat' => 'nullable|string|max:255',
            'golongan' => 'nullable|string|max:255',
            'status' => 'required|in:PNS,TNI,POLRI,PPPK,PPPK_PARUH_WAKTU,OUTSOURCING',
        ]);

        if (!empty($validated['jabatan'])) {
            $jabatanInput = strtoupper(trim($validated['jabatan']));

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

        $employee->update($validated);

        return back()->with('success', 'Profil pegawai berhasil diperbarui!');
    }

    public function destroy(Request $request, $id) // Pastikan Request ditambahkan di parameter
    {
        $user = auth()->user();

        // Cek apakah user sudah punya PIN Hapus
        if (!$user->pin_hapus) {
            return back()->with('error', 'Akses Ditolak! Anda belum mengatur PIN Hapus Pegawai. Silakan atur di menu Profil.');
        }

        // Validasi kebenaran PIN Hapus
        if (!\Illuminate\Support\Facades\Hash::check($request->pin, $user->pin_hapus)) {
            return back()->with('error', 'Otorisasi Gagal! PIN yang Anda masukkan salah.');
        }

        $employee = Employee::findOrFail($id);
        $employee->delete();
        return back()->with('success', 'Data pegawai beserta riwayatnya berhasil dihapus!');
    }

    public function updateSaldo(Request $request, $id)
    {
        $request->validate([
            'hak_cuti_n' => 'required|integer|min:0|max:12',
            'sisa_cuti_n1' => 'required|integer|min:0|max:10',
            'sisa_cuti_n2' => 'required|integer|min:0|max:10',
            'pin' => 'required', // Mewajibkan input PIN
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
            'kategori_tahunan' => 'nullable|string', // Validasi tambahan opsi
            'alasan' => 'required|string',
            'mulai_tanggal' => 'required|date',
            'sampai_tanggal' => 'required|date',
            'durasi' => 'required|integer|min:1',
        ]);

        $tahunBerjalan = (int) date('Y');
        $tahunN1 = $tahunBerjalan - 1;
        $tahunN2 = $tahunBerjalan - 2;

        $durasiCuti = $request->durasi;
        $jenisCuti = $request->jenis_cuti;

        // PENGGABUNGAN ALASAN CERDAS KHUSUS CUTI TAHUNAN
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

            // 1. Potong dari N-2
            if ($bN2 && $bN2->sisa_cuti_total > 0) {
                $potong = min($bN2->sisa_cuti_total, $sisaPengurangan);
                $bN2->sisa_cuti_total -= $potong;
                $bN2->save();
                $sisaPengurangan -= $potong;
            }

            // 2. Potong dari N-1
            if ($sisaPengurangan > 0 && $bN1 && $bN1->sisa_cuti_total > 0) {
                $potong = min($bN1->sisa_cuti_total, $sisaPengurangan);
                $bN1->sisa_cuti_total -= $potong;
                $bN1->save();
                $sisaPengurangan -= $potong;
            }

            // 3. Potong dari N
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
            'alasan' => $alasanFinal, // Simpan alasan yang sudah digabung
            'mulai_tanggal' => $request->mulai_tanggal,
            'sampai_tanggal' => $request->sampai_tanggal,
            'durasi' => $durasiCuti,
            'tahun' => $tahunBerjalan,
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
        $tahunBerjalan = $history->tahun; // Ambil tahun dari riwayat cutinya
        $tahunN1 = $tahunBerjalan - 1;
        $tahunN2 = $tahunBerjalan - 2;

        if ($jenisCuti === 'Cuti Tahunan') {
            $bN = LeaveBalance::where('employee_id', $employeeId)->where('tahun', $tahunBerjalan)->first();
            $bN1 = LeaveBalance::where('employee_id', $employeeId)->where('tahun', $tahunN1)->first();
            $bN2 = LeaveBalance::where('employee_id', $employeeId)->where('tahun', $tahunN2)->first();

            // Kembalikan ke N (Berjalan)
            if ($bN && $refundHari > 0) {
                $space = $bN->hak_cuti_dasar - $bN->sisa_cuti_total;
                if ($space > 0) {
                    $add = min($space, $refundHari);
                    $bN->sisa_cuti_total += $add;
                    $bN->save();
                    $refundHari -= $add;
                }
            }
            // Kembalikan ke N-1
            if ($bN1 && $refundHari > 0) {
                $space = $bN1->hak_cuti_dasar - $bN1->sisa_cuti_total;
                if ($space > 0) {
                    $add = min($space, $refundHari);
                    $bN1->sisa_cuti_total += $add;
                    $bN1->save();
                    $refundHari -= $add;
                }
            }
            // Kembalikan ke N-2
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
}