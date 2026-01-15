<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;

class Doctori extends Seeder
{
    public function run(): void
    {
        $doctori = [
            ['cnp_doctor' => '1970101123456','nume'=>'Popescu','prenume'=>'Alexandru','email'=>'alex.popescu@gmail.com','parola'=>bcrypt('parola123'),'specialitate_id'=>1],
            ['cnp_doctor' => '1980122123456','nume'=>'Ionescu','prenume'=>'Maria','email'=>'maria.ionescu@yahoo.com','parola'=>bcrypt('parola123'),'specialitate_id'=>2],
            ['cnp_doctor' => '1960505123456','nume'=>'Dumitrescu','prenume'=>'Andreea','email'=>'andreea.dumitrescu@gmail.com','parola'=>bcrypt('parola123'),'specialitate_id'=>3],
            ['cnp_doctor' => '1971111123456','nume'=>'Georgescu','prenume'=>'Mihai','email'=>'mihai.georgescu@gmail.com','parola'=>bcrypt('parola123'),'specialitate_id'=>1],
            ['cnp_doctor' => '1990202123456','nume'=>'Radu','prenume'=>'Elena','email'=>'elena.radu@gmail.com','parola'=>bcrypt('parola123'),'specialitate_id'=>2],
            ['cnp_doctor' => '1980603123456','nume'=>'Matei','prenume'=>'Cristian','email'=>'cristian.matei@yahoo.com','parola'=>bcrypt('parola123'),'specialitate_id'=>3],
            ['cnp_doctor' => '1970812123456','nume'=>'Barbu','prenume'=>'Ana','email'=>'ana.barbu@gmail.com','parola'=>bcrypt('parola123'),'specialitate_id'=>1],
            ['cnp_doctor' => '1990915123456','nume'=>'Neagu','prenume'=>'Bogdan','email'=>'bogdan.neagu@gmail.com','parola'=>bcrypt('parola123'),'specialitate_id'=>2],
            ['cnp_doctor' => '1960702123456','nume'=>'Enache','prenume'=>'Vlad','email'=>'vlad.enache@gmail.com','parola'=>bcrypt('parola123'),'specialitate_id'=>3],
            ['cnp_doctor' => '1980312123456','nume'=>'Toma','prenume'=>'Laura','email'=>'laura.toma@gmail.com','parola'=>bcrypt('parola123'),'specialitate_id'=>1],
        ];

        foreach ($doctori as $doctor) {
            Doctor::updateOrCreate(
                ['cnp_doctor' => $doctor['cnp_doctor']],
                $doctor
            );
        }

        $this->command->info(count($doctori) . " doctori creati.");
    }
}
