<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Specialitati extends Seeder
{
    public function run(): void
    {
        $specialitati = [
            ['nume' => 'Cardiologie'],
            ['nume' => 'Dermatologie'],
            ['nume' => 'Endocrinologie'],
            ['nume' => 'Gastroenterologie'],
            ['nume' => 'Neurologie'],
            ['nume' => 'Pediatrie'],
            ['nume' => 'Ortopedie'],
        ];

        // înlocuiește insert cu insertOrIgnore
        DB::table('specialitati')->insertOrIgnore($specialitati);

        $this->command->info(count($specialitati) . " specialitati create sau ignorate dacă existau deja.");
    }
}
