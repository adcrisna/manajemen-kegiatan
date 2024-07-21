<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('instansi_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('tempat')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('pdf')->nullable();
            $table->string('jenis_kegiatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
