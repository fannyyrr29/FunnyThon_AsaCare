<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $table = 'medical_records';

    protected $fillable = [
        'diagnose', 'description', 'date', 'rating', 'total', 'user_id', 'doctor_id'
    ];

    protected $casts = [
        'date' => 'date', 
        'rating' => 'integer', 
        'total' => 'double', 
        'user_id' => 'integer', 
        'doctor_id' => 'integer'
    ];

    public function actions(){
        return $this->belongsToMany(Action::class, 'medical_actions', 'medical_record_id', 'action_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function drugRecords(){
        return $this->hasMany(DrugRecord::class, 'medical_record_id');
    }
    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }

}
