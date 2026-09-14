<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('leave_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->integer('tahun');
            $table->integer('hak_cuti_dasar')->default(12);
            $table->integer('sisa_cuti_bawaan')->default(0);
            $table->integer('cuti_terpakai')->default(0);
            $table->integer('sisa_cuti_total')->default(0);
            $table->timestamps();
            
            $table->unique(['employee_id', 'tahun']);
        });
    }
    public function down() { Schema::dropIfExists('leave_balances'); }
};