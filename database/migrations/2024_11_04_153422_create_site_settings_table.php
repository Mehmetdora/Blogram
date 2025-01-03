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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();

            $table->string('site_name')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('favicon_url')->nullable();// tarayıcı sekmesinde görünen icon
            $table->string('theme_color', 7)->default('#ffffff'); // Örn. #ffffff
            $table->string('background_color', 7)->default('#ffffff');
            $table->string('font_family')->nullable();
            $table->integer('font_size')->default(14); // px cinsinden
            $table->string('header_image_url')->nullable();
            $table->text('footer_text')->nullable();
            $table->boolean('is_dark_mode_enabled')->default(false);
            $table->string('default_language')->default('en');
            $table->boolean('maintenance_mode')->default(false);
            $table->text('maintenance_message')->nullable();

            $table->unsignedBigInteger('editors_pick_blog_id')->nullable();

            // JSON formatında sosyal medya bağlantıları için:
            $table->json('social_links')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
