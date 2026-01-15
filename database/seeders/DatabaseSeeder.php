<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => Hash::make('parola123'),
        // ]);
        // User::create([
        //     'name' => 'Roxi',
        //     'email' => 'roxi@example.com',
        //     'password' => Hash::make('parola123'),
        // ]);
        $this->call([
            Specialitati::class,
            Doctori::class,
            PacientiSeeder::class,
            Consultatii::class,
        ]);

    }
}
