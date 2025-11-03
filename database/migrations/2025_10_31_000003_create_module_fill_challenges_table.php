<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module_fill_challenges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained()->onDelete('cascade')->index();
            $table->text('info');           // instruksi pertanyaan
            $table->text('code');           // kode rumpang
            $table->json('blanks');         // jawaban tiap blank [{answer: "", hint: ""}, ...]
            $table->text('explanation')->nullable();
            $table->integer('order')->default(1); // urutan default
            $table->string('language')->default('cpp');
            $table->integer('exp')->default(10); // EXP default
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module_fill_challenges');
    }
};
