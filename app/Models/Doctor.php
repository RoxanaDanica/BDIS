<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctori';

    protected $primaryKey = 'cnp_doctor';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['cnp_doctor', 'nume', 'parola', 'email'];  


    public function Consultatie() {
        return $this->hasManyThrough(Consultatie::class, 'cnp_doctor', 'cnp_doctor');
    }

    public function specialitate() {
        return $this->belongsTo(Specialitate::class, 'specialitate_id', 'id');
    }
}
