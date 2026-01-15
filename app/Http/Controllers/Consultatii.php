<?php

namespace App\Http\Controllers;

use App\Models\Consultatie;
use App\Models\Pacient;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class Consultatii extends Controller
{
    
    public function index()
    {
        $consultatii = Consultatie::with(['pacient', 'doctor.specialitate'])->get()->map(fn($c) => [
            'id' => $c->id,
            'cnp_pacient' => $c->cnp_pacient,
            'pacient_nume' => $c->pacient?->nume ?? '',
            'pacient_prenume' => $c->pacient?->prenume ?? '',
            'cnp_doctor' => $c->cnp_doctor,
            'doctor_nume' => $c->doctor?->nume ?? '',
            'doctor_prenume' => $c->doctor?->prenume ?? '',
            'doctor_specialitate' => $c->doctor?->specialitate?->nume ?? '',
            'data_consultatiei' => $c->data_consultatiei,
            'diagnostic' => $c->diagnostic,
            'medicamentatie' => $c->medicamentatie,
        ]);

        return Inertia::render('Consultations', [
            'consultatii' => $consultatii,
            'pacienti' => Pacient::all(),
            'doctori' => Doctor::with('specialitate')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cnp_pacient' => 'required|string|size:13',
            'cnp_doctor' => 'required|string|size:13',
            'data_consultatiei' => 'required|date',
            'diagnostic' => 'required|string',
            'medicamentatie' => 'nullable|string',
        ]);

        $exists = Consultatie::where('cnp_pacient', $data['cnp_pacient'])
            ->where('cnp_doctor', $data['cnp_doctor'])
            ->where('data_consultatiei', $data['data_consultatiei'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['duplicate' => 'Aceasta consultatie exista deja.']);
        }

        $consultatie = Consultatie::create([ 
            'cnp_pacient' => $data['cnp_pacient'],
            'cnp_doctor' => $data['cnp_doctor'],
            'data_consultatiei' => $data['data_consultatiei'],
            'diagnostic' => $data['diagnostic'],
            'medicamentatie' => $data['medicamentatie'] ?? '',
        ]);

        $consultatie = $consultatie->load('pacient', 'doctor');

        return inertia('Consultations', [
            'consultatie' => [
                'id' => $consultatie->id,
                'cnp_pacient' => $consultatie->cnp_pacient,
                'pacient_nume' => $consultatie->pacient?->nume ?? '',
                'pacient_prenume' => $consultatie->pacient?->prenume ?? '',
                'cnp_doctor' => $consultatie->cnp_doctor,
                'doctor_nume' => $consultatie->doctor?->nume ?? '',
                'doctor_prenume' => $consultatie->doctor?->prenume ?? '',
                'doctor_specialitate' => $consultatie->doctor?->specialitate ?? '',
                'data_consultatiei' => $consultatie->data_consultatiei,
                'diagnostic' => $consultatie->diagnostic,
                'medicamentatie' => $consultatie->medicamentatie,
            ]
        ]);
    }



    public function update(Request $request, Consultatie $consultatie)
    {
        $data = $request->validate([
            'cnp_pacient' => 'required|string|size:13',
            'cnp_doctor' => 'required|string|size:13',
            'data_consultatiei' => 'required|date',
            'diagnostic' => 'required|string',
            'medicamentatie' => 'nullable|string',
        ]);

        $consultatie->update([
            'cnp_pacient' => $data['cnp_pacient'],
            'cnp_doctor' => $data['cnp_doctor'],
            'data_consultatiei' => $data['data_consultatiei'],
            'diagnostic' => $data['diagnostic'],
            'medicamentatie' => $data['medicamentatie'] ?? '',
        ]);

        return redirect()->back();
    }

    public function destroy(Consultatie $consultatie)
    {
        $consultatie->delete();
        return redirect()->back();
    }
}
