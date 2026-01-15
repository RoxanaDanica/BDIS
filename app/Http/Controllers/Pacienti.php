<?php

namespace App\Http\Controllers;

use App\Models\Pacient;
use Illuminate\Http\Request;
use Inertia\Inertia;

class Pacienti extends Controller
{

    public function index()
    {
        $pacienti = Pacient::all()->map(fn ($p) => [
            'cnp' => $p->cnp,
            'nume' => $p->nume,
            'prenume' => $p->prenume,
            'dataNasterii' => $p->data_nasterii,
            'varsta' => $p->varsta,
            'adresa' => $p->adresa,
            'email' => $p->email,
            'telefon' => $p->telefon,
        ]);

        return Inertia::render('Patients', [
            'pacienti' => $pacienti
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'cnp' => 'required|string|size:13|unique:pacienti,cnp',
            'nume' => 'required|string',
            'prenume' => 'required|string',
            'dataNasterii' => 'required|date',
            'varsta' => 'required|integer',
            'adresa' => 'required|string',
            'email' => 'required|email|unique:pacienti,email',
            'telefon' => 'required|string|size:10',
        ]);

        Pacient::create([
            'cnp' => $data['cnp'],
            'nume' => $data['nume'],
            'prenume' => $data['prenume'],
            'data_nasterii' => $data['dataNasterii'],
            'varsta' => $data['varsta'],
            'adresa' => $data['adresa'],
            'email' => $data['email'],
            'telefon' => $data['telefon'],
        ]);

        return redirect()->back();
    }

    public function update(Request $request, Pacient $pacient)
    {
        $data = $request->validate([
            'nume' => 'required|string',
            'prenume' => 'required|string',
            'dataNasterii' => 'required|date',
            'varsta' => 'required|integer',
            'adresa' => 'required|string',
            'email' => 'required|email|unique:pacienti,email,' . $pacient->cnp . ',cnp',
            'telefon' => 'required|string|size:10',
        ]);

        $pacient->update([
            'nume' => $data['nume'],
            'prenume' => $data['prenume'],
            'data_nasterii' => $data['dataNasterii'],
            'varsta' => $data['varsta'],
            'adresa' => $data['adresa'],
            'email' => $data['email'],
            'telefon' => $data['telefon'],
        ]);

        return redirect()->back();
    }

    public function destroy(Pacient $pacient)
    {
        $pacient->delete();
        return redirect()->back();
    }
}
