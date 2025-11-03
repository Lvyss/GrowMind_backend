<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module_fill_challenges_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('challenge_id')->constrained('module_fill_challenges')->onDelete('cascade');
            $table->integer('blank_index'); // index untuk jawaban tiap blank
            $table->text('answer');         // jawaban user
            $table->boolean('is_correct')->default(false);
            $table->timestamps();

            // Unique constraint per user, challenge, dan blank index
            $table->unique(['user_id', 'challenge_id', 'blank_index'], 'ufcp_user_challenge_blank_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module_fill_challenges_progress');
    }
};
