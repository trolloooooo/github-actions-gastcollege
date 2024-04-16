<?php

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
        app(\Laravel\Fortify\Contracts\CreatesNewUsers::class)->create([
            'name' => 'admin',
            'email' => 'vonk@example.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('default_user');
    }
};
