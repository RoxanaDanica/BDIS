<?php

namespace App\Http\Controllers;

use App\Models\Consultatie;
use Illuminate\Http\Request;
use Inertia\Inertia;

class Statistici extends Controller
{
    public function index()
    {
        $pacientiPerSpecialitate = Consultatie::query()
            ->selectRaw('specialitati.nume as label, COUNT(DISTINCT consultatii.cnp_pacient) as value')
            ->join('doctori', 'doctori.cnp_doctor', '=', 'consultatii.cnp_doctor')
            ->join('specialitati', 'specialitati.id', '=', 'doctori.specialitate_id')
            ->groupBy('specialitati.nume')
            ->get();

        $boli = [
            'Diabet' => 'diabet',
            'Hipertensiune' => 'hipertensiune',
            'Astm' => 'astm',
            'Cancer' => 'cancer'
        ];

       $boliCronice = collect([
            'Diabet' => 'diabet',
            'Hipertensiune' => 'hipertensiune',
            'Astm' => 'astm',
            'Cancer' => 'cancer'
        ])->map(function ($keyword, $label) {
            return [
                'label' => $label,
                'value' => Consultatie::where('diagnostic', 'LIKE', "%$keyword%")
                    ->distinct('cnp_pacient')
                    ->count('cnp_pacient')
            ];
        })->values();


        return Inertia::render('Statistics', [
            'perSpecialitate' => $pacientiPerSpecialitate,
            'boliCronice' => $boliCronice
        ]);
    }
}
