<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id');
            $table->string('title')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->json('location')->nullable();
            $table->string('website')->nullable();
            $table->json('social_urls')->nullable();
            $table->string('phone_number_alt')->nullable();
            $table->string('occupation')->nullable();
            $table->string('education')->nullable();
            $table->string('information')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
