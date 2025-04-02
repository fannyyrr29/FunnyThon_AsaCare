<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyCall extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone_number', 'user_id'
    ];

    protected $casts = [
        'user_id' => 'integer'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
