<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveHistory extends Model
{
    protected $guarded = [];

    // Tambahkan relasi ini
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}