<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\LeaveBalance;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $pegawai = Employee::create([
            'nama' => 'RIRIN YUNIAWATI',
            'nip_nrp' => '19780616 200903 2 005',
            'jabatan' => 'PENGADMINISTRASI PERKANTORAN SUB BAGIAN UMUM',
            'pangkat' => 'PENATA MUDA',
            'golongan' => 'III-a',
            'status' => 'PNS'
        ]);

        // Berikan saldo cuti untuk tahun 2026
        LeaveBalance::create([
            'employee_id' => $pegawai->id,
            'tahun' => 2026,
            'hak_cuti_dasar' => 12,
            'sisa_cuti_bawaan' => 0,
            'cuti_terpakai' => 0,
            'sisa_cuti_total' => 12
        ]);
    }
}