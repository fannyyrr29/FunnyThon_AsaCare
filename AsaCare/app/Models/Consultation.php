<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','doctor_id','medical_record_id'];
    protected $casts = [
        'medical_record_id' => 'integer',
        'user_id' => 'integer',
        'doctor_id' => 'integer'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function doctor(){
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }

    public function messages(){
        return $this->hasMany(Message::class, 'consultation_id', 'id');
    }

    public function medicalRecord(){
        return $this->belongsTo(MedicalRecord::class, 'medical_record_id', 'id');
    }
}
