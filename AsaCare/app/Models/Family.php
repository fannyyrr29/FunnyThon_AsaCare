<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $fillable = ['sender_id','receiver_id','status'];
    protected $casts = [
        'sender_id' => 'integer',
        'receiver_id' => 'integer',
        'status' => 'integer'
    ];

    public function sender(){
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function receiver(){
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }
}
