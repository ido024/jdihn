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
        Schema::create('arsip_perkaras', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('perkara_id')->nullable();
            $table->date('tgl_arsip')->nullable();

            $table->text('file_1')->nullable();
            $table->text('type_1')->nullable();
            $table->unsignedInteger('size_1')->nullable();

            $table->text('file_2')->nullable();
            $table->text('type_2')->nullable();
            $table->unsignedInteger('size_2')->nullable();

            $table->text('file_3')->nullable();
            $table->text('type_3')->nullable();
            $table->unsignedInteger('size_3')->nullable();

            $table->text('file_4')->nullable();
            $table->text('type_4')->nullable();
            $table->unsignedInteger('size_4')->nullable();

            $table->text('file_5')->nullable();
            $table->text('type_5')->nullable();
            $table->unsignedInteger('size_5')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_perkaras');
    }
};
