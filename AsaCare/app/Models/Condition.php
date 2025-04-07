<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    use HasFactory;

    protected $fillable = ['condition', 'date', 'user_id'];

    protected $casts = [
        'date' => 'date', 
        'user_id' => 'integer',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
