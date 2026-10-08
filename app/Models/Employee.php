<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'employee_id');
    }


    public function leaveBalances()
    {
        return $this->hasMany(LeaveBalance::class);
    }

    // Tambahkan baris ini:
    public function leaveHistories()
    {
        return $this->hasMany(LeaveHistory::class);
    }


    // Menambahkan perhitungan otomatis Masa Kerja
    public function getMasaKerjaAttribute()
    {
        if (!$this->tanggal_mulai_kerja)
            return '-';

        $start = \Carbon\Carbon::parse($this->tanggal_mulai_kerja);
        $now = \Carbon\Carbon::now();
        $diff = $start->diff($now);

        $teks = '';
        if ($diff->y > 0)
            $teks .= $diff->y . ' Tahun ';
        if ($diff->m > 0)
            $teks .= $diff->m . ' Bulan';

        return trim($teks) ?: 'Kurang dari 1 bulan';
    }
}