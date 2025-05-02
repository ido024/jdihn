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
        Schema::create('perkaras', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('penuntut_id')->nullable();
            $table->bigInteger('hakim_id')->nullable();
            $table->bigInteger('jaksa_id')->nullable();
            $table->bigInteger('jenis_tindak_pidana_id')->nullable();


            $table->string('nomor_perkara')->nullable();
            $table->date('tanggal_pendaftaran')->nullable();
            $table->string('nama_terdakwa')->nullable();
            $table->date('tanggal_putusan')->nullable();
            $table->string('alamat_terdakwa')->nullable();
            $table->string('status_perkara')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perkaras');
    }
};
