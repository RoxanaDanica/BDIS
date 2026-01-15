<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pacient extends Model
{
    protected $table = 'pacienti';
    protected $primaryKey = 'cnp'; 
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'cnp',
        'nume',
        'prenume',
        'data_nasterii',
        'varsta',
        'adresa',
        'email',
        'telefon',
    ];

    public function consultatii() {
        return $this->hasMany(Consultatie::class, 'cnp_pacient', 'cnp');
    }
}
