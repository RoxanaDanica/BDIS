<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Consultatie;
use App\Models\Pacient;
use App\Models\Doctor;
use Carbon\Carbon;

class Consultatii extends Seeder
{
    public function run(): void
    {
        $pacienti = Pacient::all();
        $doctori = Doctor::all();

        if ($pacienti->isEmpty() || $doctori->isEmpty()) {
            $this->command->info("Nu există pacienți sau doctori. Seed-ul consultatii nu poate rula.");
            return;
        }

        for ($i = 1; $i <= 10; $i++) {
            $pacient = $pacienti->random();
            $doctor = $doctori->random();

            $dataConsultatiei = Carbon::now()->subDays(rand(0, 365))->format('Y-m-d');

            Consultatie::create([
                'cnp_pacient' => $pacient->cnp,
                'cnp_doctor' => $doctor->cnp_doctor,
                'data_consultatiei' => $dataConsultatiei,
                'diagnostic' => "Diagnostic pentru {$pacient->nume} {$pacient->prenume} - consult #{$i}",
                'medicamentatie' => "Medicamente recomandate pentru consult #{$i}",
            ]);
        }

        $this->command->info("S-au creat 10 consultatii random.");
    }
}
