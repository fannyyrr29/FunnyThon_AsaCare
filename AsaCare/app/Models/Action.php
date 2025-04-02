<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'image', 'type', 'price' 
    ];

    protected $casts = [
        'price' => 'double'
    ];

    public function medicalrecords(){
        return $this->belongsToMany(MedicalRecord::class, 'medical_actions', 'action_id', 'medical_record_id');
    }

}
