<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReminderTime extends Model
{
    use HasFactory;

    protected $table = 'reminder_times';

    protected $fillable = [
        'reminder_id',
        'time_id',
        'date',
        'status'
    ];

    public function reminder(){
        return $this->belongsTo(Reminder::class);
    }

    // Relasi ke Time
    public function time()
    {
        return $this->belongsTo(Time::class);
    }
}
