<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('module_section_questions', function (Blueprint $table) {
            $table->id();

            // Section relationship
            $table->foreignId('section_id')
                ->constrained('module_sections')
                ->onDelete('cascade');

            // type (maybe we add mcq later)
            $table->enum('type', ['fill_code'])->default('fill_code');

            // Instruction / perintah
            $table->text('instruction')->nullable();

            // Teks template dengan blank pakai ___
            $table->text('template');

            // Jawaban dalam array JSON ["program", "data"]
            $table->json('answers');

            // Poin soal
            $table->integer('points')->default(1);

            // Urutan soal dalam section
            $table->integer('order')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module_section_questions');
    }
};
