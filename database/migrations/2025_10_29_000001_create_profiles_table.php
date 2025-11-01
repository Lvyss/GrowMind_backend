<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::create('profiles', function (Blueprint $table) {
$table->id();
$table->foreignId('user_id')->constrained()->onDelete('cascade');
$table->text('bio')->nullable();
$table->integer('level')->default(1);
$table->integer('exp')->default(0);
$table->integer('tree_stage')->default(1);
$table->integer('tree_points')->default(0);
$table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
