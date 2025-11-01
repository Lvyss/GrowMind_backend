<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
Schema::create('user_progress', function (Blueprint $table) {
$table->id();
$table->foreignId('user_id')->constrained()->onDelete('cascade');
$table->foreignId('module_id')->constrained()->onDelete('cascade');
$table->foreignId('lesson_id')->nullable()->constrained()->onDelete('cascade');
$table->boolean('is_completed')->default(false);
$table->integer('score')->nullable();
$table->integer('exp_earned')->default(0);
$table->timestamps();
});


    }

    public function down(): void {
        Schema::dropIfExists('user_progress');
    }
};
