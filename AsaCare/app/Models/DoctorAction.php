<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorAction extends Model
{
    use HasFactory;
    protected $table = 'doctor_has_actions';
    protected $fillable = [
        'doctor_id', 'action_id'
    ];

    protected $casts = [
        'doctor_id' => 'integer',
        'action_id' => 'integer'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function action()
    {
        return $this->belongsTo(Action::class);
    }
}
