<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialitate extends Model
{
    protected $table = 'specialitati';

    protected $fillable = [
        'nume'
    ];

    public function doctori() {
        return $this->hasMany(Doctor::class);
    }
}
