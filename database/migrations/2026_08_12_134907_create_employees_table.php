<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip_nrp')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('pangkat')->nullable();
            $table->string('golongan')->nullable();
            $table->enum('status', ['PNS', 'TNI', 'POLRI', 'PPPK', 'PPPK_PARUH_WAKTU', 'OUTSOURCING']);
            $table->string('ket')->nullable();
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('employees'); }
};