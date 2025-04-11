<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'medical_record_id', 'drug_id', 'status', 'start_date', 'duration_day'
    ];

    protected $casts = [
        'user_id' => 'integer', 
        'medical_record_id' => 'integer', 
        'drug_id' => 'integer', 
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

    public function times()
    {
        return $this->belongsToMany(Time::class, 'reminder_times', 'reminder_id', 'time_id');
    }

    public function reminderTimes()
    {
        return $this->hasMany(ReminderTime::class);
    }

    public function drug()
    {
        return $this->belongsTo(Drug::class, 'drug_id');
    }



}
