<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan role (admin/pegawai)
            $table->enum('role', ['admin', 'pegawai'])->default('pegawai')->after('id');
            // Menghubungkan akun dengan data pegawai di tabel employees
            $table->foreignId('employee_id')->nullable()->after('role')->constrained('employees')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->dropColumn(['role', 'employee_id']);
        });
    }
};