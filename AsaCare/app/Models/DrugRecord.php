<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugRecord extends Model
{
    use HasFactory;

    protected $table = 'drug_records';

    protected $fillable = ['medical_record_id', 'drug_id', 'amount', 'subtotal', 'status'];

    protected $casts = [
        'medical_record_id' => 'integer',
        'drug_id' => 'integer',
        'amount' => 'integer',
        'subtotal' => 'double',
        'status' => 'integer', 
    ];

    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }

    public function drug(){
        return $this->belongsTo(Drug::class, 'drug_id', 'id');
    }

    public function reminders(){
        return $this->hasMany(Reminder::class);
    }

}
