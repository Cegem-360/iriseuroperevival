<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@europeRevival.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => UserRole::Admin,
                'email_verified_at' => now(),
            ],
        );
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'role' => UserRole::Admin,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
    }
}
