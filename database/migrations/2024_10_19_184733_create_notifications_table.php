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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            $table->boolean('status')->default(true);
            $table->foreignId('receiver_id')->references('id')->on('users')->cascadeOnDelete();
            $table->bigInteger('sender_id')->unsigned()->nullable();
            $table->bigInteger('mentioned_id')->unsigned()->nullable()->comment('Eğer blogla ilgili ise');
            $table->string('type')->comment('like, new-comment, new-fallower gibi');
            $table->string('content');
            $table->string('title');
            $table->string('url')->nullable()->comment('bildirime tıklandığında yölendirilecek sayfa urli');
            $table->timestamp('read_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
