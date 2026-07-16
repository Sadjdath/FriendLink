<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('privacy_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();

            $table->enum('profile_visibility', ['public', 'shared_interests', 'invite_only'])
                ->default('shared_interests');

            $table->enum('who_can_contact', ['everyone', 'verified_only', 'shared_interests'])
                ->default('verified_only');

            $table->boolean('requires_manual_whatsapp_confirmation')->default(false);

            $table->unsignedInteger('max_distance_km')->nullable();
            $table->json('excluded_interest_categories')->nullable();

            $table->unsignedTinyInteger('min_contact_age')->nullable();
            $table->unsignedTinyInteger('max_contact_age')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('privacy_settings');
    }
};
