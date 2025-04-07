<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function doctors(){
        return $this->belongsToMany(Doctor::class, 'doctor_has_specialization', 'specialization_id', 'doctor_id')->withPivot('action_id')->withTimestamps();
    }
}
