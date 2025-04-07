<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    protected $fillable = [
        'time'
    ];

    protected $casts = [
        'time' => 'datetime:H:i:s'
    ];

    public function reminders()
    {
        return $this->belongsToMany(Reminder::class, 'reminder_times', 'times_id', 'reminders_user_id')
                    ->withPivot('reminders_medical_record_id', 'reminders_drug_id');
    }
}
