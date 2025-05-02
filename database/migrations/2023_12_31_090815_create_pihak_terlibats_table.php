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
        Schema::create('pihak_terlibats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('perkara_id')->nullable();
            $table->string('no_pihak_t')->nullable();
            $table->string('nama_pihak')->nullable();
            $table->text('alamat')->nullable();
            $table->string('tipe_pihak')->nullable();
            $table->string('no_hp_pihak_terlibat')->nullable();

            $table->text('file_1')->nullable();
            $table->text('type_1')->nullable();
            $table->unsignedInteger('size_1')->nullable();
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pihak_terlibats');
    }
};
