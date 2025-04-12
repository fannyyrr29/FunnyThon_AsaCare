<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'license_number', 'experience_year', 'rating', 'hospital_id', 'user_id', 'specialization_id'
    ];

    protected $casts = [
        'experience_year' => 'integer',
        'rating' => 'double', 
        'specialization_id' => 'integer',
        'hospital_id' => 'integer', 
        'user_id' => 'integer'
    ];


    public function medicalrecords(){
        return $this->hasMany(MedicalRecord::class, 'doctor_id');
    }

    public function hospital(){
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id');
        // return $this->belongsToMany(Specialization::class, 'doctor_has_specializations', 'doctor_id', 'specialization_id');
    }


    public function actions()
    {
        return $this->belongsToMany(Action::class, 'doctor_has_actions', 'doctor_id', 'action_id');
    }

    // public function doctorSpecialization()
    // {
    //     return $this->hasMany(DoctorSpecialization::class);
    // }
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
