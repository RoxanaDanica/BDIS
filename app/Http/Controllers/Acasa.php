<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class Acasa extends Controller
{
    public function index()
    {
        $pacienti = [
            [
                'cnp' => '1960523123456',
                'nume' => 'Popescu',
                'prenume' => 'Andrei',
                'dataNasterii' => '1996-05-23',
                'varsta' => 28,
                'adresa' => 'Str. Lalelelor nr. 10, Bucuresti',
                'email' => 'andrei.popescu@gmail.com',
                'telefon' => '0723456789',
            ],
            [
                'cnp' => '1980615123456',
                'nume' => 'Ionescu',
                'prenume' => 'Maria',
                'dataNasterii' => '1998-06-15',
                'varsta' => 26,
                'adresa' => 'Str. Libertatii nr. 22, Cluj',
                'email' => 'maria.ionescu@yahoo.com',
                'telefon' => '0744123456',
            ],
            [
                'cnp' => '1951109123456',
                'nume' => 'Dumitru',
                'prenume' => 'Ion',
                'dataNasterii' => '1955-11-09',
                'varsta' => 69,
                'adresa' => 'Str. Viitorului nr. 5, Iasi',
                'email' => 'ion.dumitru@gmail.com',
                'telefon' => '0733987654',
            ],
            [
                'cnp' => '2000101123456',
                'nume' => 'Georgescu',
                'prenume' => 'Raluca',
                'dataNasterii' => '2000-01-01',
                'varsta' => 25,
                'adresa' => 'Str. Pacii nr. 44, Brasov',
                'email' => 'raluca.geo@gmail.com',
                'telefon' => '0765123987',
            ],
            [
                'cnp' => '1970823123456',
                'nume' => 'Radu',
                'prenume' => 'Daniel',
                'dataNasterii' => '1977-08-23',
                'varsta' => 47,
                'adresa' => 'Str. Stadionului nr. 9, Craiova',
                'email' => 'daniel.radu@gmail.com',
                'telefon' => '0722998877',
            ],
            [
                'cnp' => '1991212123456',
                'nume' => 'Matei',
                'prenume' => 'Laura',
                'dataNasterii' => '1999-12-12',
                'varsta' => 25,
                'adresa' => 'Str. Primaverii nr. 3, Sibiu',
                'email' => 'laura.matei@gmail.com',
                'telefon' => '0755332211',
            ],
            [
                'cnp' => '1960303123456',
                'nume' => 'Stoica',
                'prenume' => 'Mihnea',
                'dataNasterii' => '1966-03-03',
                'varsta' => 58,
                'adresa' => 'Str. Castanilor nr. 14, Pitesti',
                'email' => 'mihnea.stoica@yahoo.com',
                'telefon' => '0746001122',
            ],
            [
                'cnp' => '1980418123456',
                'nume' => 'Neagu',
                'prenume' => 'Bogdan',
                'dataNasterii' => '1988-04-18',
                'varsta' => 36,
                'adresa' => 'Str. Orhideelor nr. 8, Targoviste',
                'email' => 'bogdan.neagu@gmail.com',
                'telefon' => '0733112233',
            ],
            [
                'cnp' => '1970911123456',
                'nume' => 'Barbu',
                'prenume' => 'Alina',
                'dataNasterii' => '1977-09-11',
                'varsta' => 47,
                'adresa' => 'Str. Nordului nr. 1, Constanta',
                'email' => 'alina.barbu@gmail.com',
                'telefon' => '0724556677',
            ],
            [
                'cnp' => '2000222123456',
                'nume' => 'Lazar',
                'prenume' => 'Stefan',
                'dataNasterii' => '2000-02-22',
                'varsta' => 24,
                'adresa' => 'Str. Morii nr. 19, Arad',
                'email' => 'stefan.lazar@gmail.com',
                'telefon' => '0788990011',
            ],
            [
                'cnp' => '1961225123456',
                'nume' => 'Enache',
                'prenume' => 'Vasile',
                'dataNasterii' => '1966-12-25',
                'varsta' => 58,
                'adresa' => 'Str. Dunarii nr. 6, Galati',
                'email' => 'vasile.enache@gmail.com',
                'telefon' => '0721445566',
            ],
            [
                'cnp' => '1990707123456',
                'nume' => 'Toma',
                'prenume' => 'Irina',
                'dataNasterii' => '1999-07-07',
                'varsta' => 25,
                'adresa' => 'Str. Soarelui nr. 11, Deva',
                'email' => 'irina.toma@gmail.com',
                'telefon' => '0759003344',
            ],
        ];

        return Inertia::render('Acasa', [
            'pacienti' => $pacienti,
        ]);
    }
}
