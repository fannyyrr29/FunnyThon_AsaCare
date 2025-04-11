<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = ['medical_record_id'];
    protected $casts = ['medical_record_id' => 'integer'];


    public function messages(){
        return $this->hasMany(Message::class, 'consultation_id', 'id');
    }
}
