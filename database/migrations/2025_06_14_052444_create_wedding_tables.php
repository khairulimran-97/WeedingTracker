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
        Schema::create('wedding_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('category');
            $table->string('priority')->default('medium');
            $table->boolean('is_completed')->default(false);
            $table->date('deadline')->nullable();
            $table->json('notes')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('wedding_settings', function (Blueprint $table) {
            $table->id();
            $table->string('bride_name')->default('Madihah');
            $table->string('groom_name')->default('Khairul');
            $table->string('hashtag')->default('#KhairulMadihah');
            $table->date('wedding_date')->default('2024-12-25');
            $table->string('theme_color')->default('#E8B4B8');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wedding_tasks');
        Schema::dropIfExists('wedding_settings');
    }
};
