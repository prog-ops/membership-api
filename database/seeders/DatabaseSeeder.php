<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ======================================================================
        // BAGIAN 1: Panggil ContentSeeder untuk mengisi artikel dan video.
        // Ini adalah statement yang berdiri sendiri.
        // ======================================================================
        $this->call([
            ContentSeeder::class,
        ]);

        // ======================================================================
        // BAGIAN 2: (Opsional) Buat user dummy untuk testing.
        // Ini juga statement yang berdiri sendiri dan terpisah.
        // ======================================================================

        // Buat 1 user Tipe A
        User::factory()->create([
            'name' => 'User Tipe A',
            'email' => 'usera@example.com',
            'membership_type' => 'A'
        ]);

        // Buat 1 user Tipe B
        User::factory()->create([
            'name' => 'User Tipe B',
            'email' => 'userb@example.com',
            'membership_type' => 'B'
        ]);

        // Buat 1 user Tipe C
        User::factory()->create([
            'name' => 'User Tipe C',
            'email' => 'userc@example.com',
            'membership_type' => 'C'
        ]);

        // Buat 5 user acak lainnya dengan Tipe A (default)
        User::factory(5)->create();
    }
}
