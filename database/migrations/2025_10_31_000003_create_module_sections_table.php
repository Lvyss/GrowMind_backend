<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::create('module_sections', function (Blueprint $table) {
    $table->id();
    $table->foreignId('module_id')->constrained()->onDelete('cascade');
    $table->string('title');
    $table->integer('order')->default(1);
    $table->json('content')->nullable(); // materi & soal inline
    $table->integer('xp_reward')->default(10);
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('module_sections');
    }
};
