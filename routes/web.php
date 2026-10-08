<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\AuthController;

// Rute Halaman Login (GET)
Route::get('/', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');

// Rute Pemroses Data Login (POST) - Ini yang dituju oleh form
Route::post('/login', [AuthController::class, 'login']);

// Rute Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute yang Membutuhkan Autentikasi
Route::middleware('auth')->group(function () {
    // Rute Profil Baru
    Route::get('/profil', [AuthController::class, 'profile'])->name('profil');
    Route::post('/profil/update', [AuthController::class, 'updateProfile'])->name('profil.update');

    // Rute Dashboard & Manajemen Pegawai
    Route::get('/dashboard', [LeaveController::class, 'index'])->name('dashboard');
    Route::post('/pegawai', [LeaveController::class, 'store'])->name('pegawai.store');
    Route::put('/pegawai/{id}', [LeaveController::class, 'update'])->name('pegawai.update');
    Route::delete('/pegawai/{id}', [LeaveController::class, 'destroy'])->name('pegawai.destroy');
    Route::post('/pegawai/{id}/saldo', [LeaveController::class, 'updateSaldo']);

    // Rute Manajemen Cuti
    Route::post('/cuti', [LeaveController::class, 'storeCuti'])->name('cuti.store');
    Route::delete('/cuti/{id}', [LeaveController::class, 'destroyCuti'])->name('cuti.destroy');

    // Rute Dashboard Khusus Pegawai
    Route::get('/pegawai/dashboard', [LeaveController::class, 'dashboardPegawai'])->name('pegawai.dashboard');

    // Rute Cetak Surat Cuti
    Route::get('/cuti/{id}/cetak', [LeaveController::class, 'cetakSurat'])->name('cuti.cetak');

    // Rute Konfirmasi Cuti oleh Admin
    Route::post('/cuti/{id}/konfirmasi', [LeaveController::class, 'konfirmasiCuti'])->name('cuti.konfirmasi');
});

// --- JALUR PINTAS UPDATE/GENERATE AKUN MASSAL (RE-SYNC) ---
Route::get('/generate-akun-massal', function () {
    $pegawais = \App\Models\Employee::all();
    $countBaru = 0;
    $countUpdate = 0;

    foreach ($pegawais as $p) {
        // Ambil nama depan kecil semua tanpa spasi/tanda baca
        $pecahNama = explode(' ', trim($p->nama));
        $baseUsername = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $pecahNama[0]));
        if (empty($baseUsername))
            $baseUsername = 'pegawai';

        $usernameFinal = $baseUsername;
        $counter = 1;

        // Cari User yang sudah terhubung dengan pegawai ini
        $user = \App\Models\User::where('employee_id', $p->id)->first();

        // Loop untuk memastikan username unik (kecuali jika itu username milik dia sendiri)
        while (
            \App\Models\User::where('username', $usernameFinal)
                ->where('employee_id', '!=', $p->id) // Jangan anggap kembar jika ID-nya sama
                ->exists()
        ) {
            $usernameFinal = $baseUsername . $counter;
            $counter++;
        }

        if ($user) {
            // JIKA AKUN SUDAH ADA: Update username-nya ke format baru
            $user->update([
                'username' => $usernameFinal,
                'email' => $usernameFinal . '_' . $p->id . '@bnn.go.id',
                // Kita kembalikan password ke default agar admin mudah menyampaikannya
                'password' => bcrypt('bnnkmalang'),
            ]);
            $countUpdate++;
        } else {
            // JIKA BELUM PUNYA AKUN: Buat baru
            \App\Models\User::create([
                'role' => 'pegawai',
                'employee_id' => $p->id,
                'name' => $p->nama,
                'username' => $usernameFinal,
                'email' => $usernameFinal . '_' . $p->id . '@bnn.go.id',
                'password' => bcrypt('bnnkmalang'),
            ]);
            $countBaru++;
        }
    }

    return "Sinkronisasi Selesai! <br> Akun Baru Dibuat: {$countBaru} <br> Akun Lama Diperbarui: {$countUpdate} <br><br> Format semua username sekarang: Nama depan kecil.";
});

























//