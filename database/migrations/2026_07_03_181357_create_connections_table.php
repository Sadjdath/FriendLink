<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('connections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('connection_request_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_one_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('user_two_id')->constrained('users')->cascadeOnDelete();

            $table->enum('whatsapp_status', ['locked', 'conditional', 'unlocked'])->default('locked');
            $table->timestamp('whatsapp_unlocked_at')->nullable();

            $table->unsignedInteger('whatsapp_opened_count')->default(0);
            $table->timestamp('whatsapp_last_opened_at')->nullable();

            $table->timestamps();

            $table->unique(['user_one_id', 'user_two_id']);
            $table->index('whatsapp_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('connections');
    }
};