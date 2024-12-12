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
        Schema::create('blog_photo', function (Blueprint $table) {
            $table->id();

            $table->foreignId('blog_id')->references('id')->on('blogs')->cascadeOnDelete();
            $table->string('image_name')->comment('her bloğun description içine text editor ile yüklenmiş görseli');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_photo');
    }
};
