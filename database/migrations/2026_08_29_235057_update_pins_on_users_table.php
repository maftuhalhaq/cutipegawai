<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('pin'); // Hapus PIN lama
            $table->string('pin_cuti')->nullable()->after('password');
            $table->string('pin_hapus')->nullable()->after('pin_cuti');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('pin')->nullable();
            $table->dropColumn(['pin_cuti', 'pin_hapus']);
        });
    }
};