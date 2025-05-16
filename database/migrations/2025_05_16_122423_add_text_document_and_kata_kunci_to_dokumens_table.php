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
        Schema::table('dokumens', function (Blueprint $table) {
            $table->date('tgl_ditetapkan')->nullable()->after('size_abstrak');
            $table->date('tgl_diundangkan')->nullable()->after('text_document');
        });
    }

    public function down(): void
    {
        Schema::table('dokumens', function (Blueprint $table) {
            $table->dropColumn(['tgl_ditetapkan', 'tgl_diundangkan']);
        });
    }
};
