<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('connection_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('receiver_id')->constrained('users')->cascadeOnDelete();
            $table->string('message', 280)->nullable();
            $table->enum('status', ['pending', 'accepted', 'declined', 'expired', 'cancelled'])
                ->default('pending');
            $table->timestamp('responded_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            $table->unique(['sender_id', 'receiver_id']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('connection_requests');
    }
};
