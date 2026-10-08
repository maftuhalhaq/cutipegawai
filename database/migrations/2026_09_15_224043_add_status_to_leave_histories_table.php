<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('leave_histories', function (Blueprint $table) {
            // Menambah kolom status_pengajuan dengan nilai default 'Menunggu'
            $table->enum('status_pengajuan', ['Menunggu', 'Disetujui', 'Ditolak'])->default('Menunggu')->after('tahun');
        });
    }

    public function down(): void
    {
        Schema::table('leave_histories', function (Blueprint $table) {
            $table->dropColumn('status_pengajuan');
        });
    }
};