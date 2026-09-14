<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    public function leaveBalances()
    {
        return $this->hasMany(LeaveBalance::class);
    }

    // Tambahkan baris ini:
    public function leaveHistories()
    {
        return $this->hasMany(LeaveHistory::class);
    }
}