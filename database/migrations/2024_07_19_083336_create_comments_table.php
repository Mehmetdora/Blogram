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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->string('content',250)->nullable(false);
            $table->boolean('status')->default(true)->comment('1 ise aktif, 0 ise kapalı');
            $table->foreignId('parent_id')->nullable()->references('id')->on('comments')->cascadeOnDelete();
            $table->foreignId('blog_id')->references('id')->on('blogs')->cascadeOnDelete();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
