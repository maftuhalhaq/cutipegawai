<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('leave_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->string('jenis_cuti');
            $table->text('alasan');
            $table->date('mulai_tanggal');
            $table->date('sampai_tanggal');
            $table->integer('durasi');
            $table->integer('tahun');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('leave_histories');
    }
};