<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'medical_record_id', 'drug_id', 'time_id', 'status', 'start_date', 'duration_day'
    ];

    protected $casts = [
        'user_id' => 'integer', 
        'medical_record_id' => 'integer', 
        'drug_id' => 'integer', 
        'time_id' => 'integer', 
        'status' => 'integer',
        'start_date' => 'date', 
        'duration_day' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function drugRecord()
    {
        return $this->belongsTo(DrugRecord::class);
    }
}
