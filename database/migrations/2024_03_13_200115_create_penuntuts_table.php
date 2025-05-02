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
        Schema::create('penuntuts', function (Blueprint $table) {
            $table->id();
            $table->string('no_tuntutan')->nullable();
            $table->string('nama_penuntut')->nullable();
            $table->string('nama_terdakwa')->nullable();
            $table->string('umur_terdakwa')->nullable();
            $table->date('tgl_tuntutan')->nullable();
            $table->string('no_hp_penuntut')->nullable();
            $table->string('alamat_penuntut')->nullable();
            $table->text('kasus_dugaan')->nullable();
            $table->text('bukti_foto1')->nullable();
            $table->text('bukti_foto2')->nullable();
            $table->text('bukti_foto3')->nullable();
            $table->text('bukti_foto4')->nullable();
            $table->text('bukti_foto5')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penuntuts');
    }
};
