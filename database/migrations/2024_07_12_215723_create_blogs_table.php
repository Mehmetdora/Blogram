<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(true)->comment('1 ise myBlogs yayında,0 ise değil');
            $table->boolean('is_confirmed')->default(true)->comment('true ise onaylanmıştır, false ise admin tarafından onaylanmayı bekliyordur');
            $table->string('title',100)->nullable(false);
            $table->string('cover_photo')->nullable(false);
            $table->string('summery')->nullable(false);
            $table->text('description')->nullable(false);
            $table->integer('min_to_read')->default(0)->comment('blogun ortalama okunma süresi');
            $table->unsignedInteger('like_count');
            $table->unsignedInteger('comment_count');
            $table->unsignedInteger('save_count');
            $table->bigInteger('category_id')->nullable(false);
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
