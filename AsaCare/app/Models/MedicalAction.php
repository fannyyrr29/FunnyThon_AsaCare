<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalAction extends Model
{
    use HasFactory;
    protected $table = 'medical_actions';

    protected $fillable = [
        'medical_record_id', 'action_id'
    ];
    
    protected $casts = [
        'medical_record_id' => 'integer', 
        'action_id' => 'integer'
    ];

    
}
