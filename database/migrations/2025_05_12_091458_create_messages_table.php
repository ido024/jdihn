<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    // database/migrations/xxxx_xx_xx_create_messages_table.php
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade'); // Untuk menghubungkan dengan pengguna
            $table->text('message');
            $table->boolean('is_admin')->default(false); // Menandakan apakah pesan dari admin
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
}
