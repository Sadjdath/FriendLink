<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->unique();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->date('birthdate')->nullable();
            $table->enum('gender', ['homme', 'femme', 'autre', 'non_precise'])->default('non_precise');
            $table->text('bio')->nullable();
            $table->string('profession')->nullable();
            $table->string('avatar_path')->nullable();
            $table->enum('photo_moderation_status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->enum('account_status', ['active', 'suspended', 'banned', 'deactivated'])->default('active');
            $table->timestamp('last_active_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['latitude', 'longitude']);
            $table->index('account_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
