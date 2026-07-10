<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('category', ['loisir', 'sport', 'profession', 'culture', 'langue', 'autre'])->default('loisir');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('interest_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('interest_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['user_id', 'interest_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interest_user');
        Schema::dropIfExists('interests');
    }
};
