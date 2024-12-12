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
        Schema::create('saved_blogs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('blog_id')->references('id')->on('blogs')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_blogs');
    }
};
