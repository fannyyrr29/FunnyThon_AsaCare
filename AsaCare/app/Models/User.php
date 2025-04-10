<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\Role;
use Faker\Provider\Medical;
use GuzzleHttp\RetryMiddleware;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'role',
        'birthdate',     
        'email',
        'password',
        'google_id',
        'google_token',
        'google_refresh_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function medicalrecords(){
        return $this->hasMany(MedicalRecord::class, 'user_id');
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }

    public function emergencyCall(){
        return $this->hasMany(EmergencyCall::class, 'user_id', 'id');
    }

    public function conditions(){
        return $this->hasMany(Condition::class, 'user_id', 'id');
    }

    //cek user diundang oleh siapa saja
    public function senders() {
        return $this->belongsToMany(User::class, 'families', 'receiver_id', 'sender_id')->withPivot('status')
                ->withTimestamps();
    }    

    //cek user mengundang siapa saja
    public function receivers(){
        return $this->belongsToMany(User::class, 'families', 'sender_id', 'receiver_id')->withPivot('status')
                ->withTimestamps();
    }

    public function families() {
        return $this->belongsToMany(User::class, 'families', 'sender_id', 'receiver_id')->withPivot('status');
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class, 'user_id', 'id');
    }
    
}
