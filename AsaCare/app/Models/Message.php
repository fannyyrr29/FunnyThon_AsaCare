<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['consultation_id', 'sender_id', 'message'];

    protected $casts = [
        'consultation_id' => 'integer',
        'sender_id' => 'integer'
    ];


    public function consultation(){
        return $this->belongsTo(Consultation::class, 'consultation_id');
    }
    
    public function sender(){
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

}
