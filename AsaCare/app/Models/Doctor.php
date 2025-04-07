<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'license_number', 'experience_year', 'rating', 'hospital_id'
    ];

    protected $casts = [
        'experience_year' => 'integer',
        'rating' => 'double', 
        'hospital_id' => 'integer'
    ];


    public function medicalrecords(){
        return $this->hasMany(MedicalRecord::class, 'doctor_id');
    }

    public function hospital(){
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    public function specialization(){
        return $this->belongsToMany(Specialization::class, 'doctor_has_specializations', 'doctor_id', 'specialization_id')->withPivot('action_id')->withTimestamps();
    }
}
