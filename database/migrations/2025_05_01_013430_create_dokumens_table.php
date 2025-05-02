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
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jenis_dokuemn_id')->nullable();
            $table->string('asal_dokumen')->nullable();
            $table->string('nomor')->nullable();
            $table->string('tahun')->nullable();
            $table->string('judul')->nullable();
            $table->string('teu')->nullable();
            $table->string('singkatan_jenis')->nullable();
            $table->string('tempat_terbit')->nullable();
            $table->date('tgl_penetapan')->nullable();
            $table->string('subyek')->nullable();
            $table->string('status')->nullable();
            $table->string('penandatanganan')->nullable();
            $table->string('sumber')->nullable();
            $table->string('bahasa')->nullable();

            $table->text('abstrak')->nullable();
            $table->text('document')->nullable();
            $table->text('type_document')->nullable();
            $table->unsignedInteger('size_document')->nullable();
            $table->text('type_abstrak')->nullable();
            $table->unsignedInteger('size_abstrak')->nullable();




            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
