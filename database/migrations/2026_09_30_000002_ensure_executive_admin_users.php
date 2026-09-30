<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Mais Agro Primary Admin
        User::updateOrCreate(
            ['email' => 'admin@maisagrohouse.com'],
            [
                'name' => 'Mais Agro Executive Admin',
                'password' => Hash::make('Password@123'),
                'role' => 'admin',
                'phone' => '+91 80080 07062',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80',
                'is_active' => true,
            ]
        );

        // 2. HarshMais Group Admin
        User::updateOrCreate(
            ['email' => 'admin@harshmais.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('Password@123'),
                'role' => 'admin',
                'phone' => '+91 90090 08014',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80',
                'is_active' => true,
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Keep users intact
    }
};
