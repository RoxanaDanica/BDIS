<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultatie extends Model
{
     protected $table = 'consultatii';

     protected $fillable = [
        'cnp_pacient',
        'cnp_doctor',
        'data_consultatiei',
        'diagnostic',
        'medicamentatie'
    ];

    public function pacient() {
        return $this->belongsTo(Pacient::class, 'cnp_pacient', 'cnp');
    }

    public function doctor() {
        return $this->belongsTo(Doctor::class, 'cnp_doctor', 'cnp_doctor');
    }
}
