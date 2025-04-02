<?php

namespace App\Models;

use Dotenv\Dotenv;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Comment\Doc;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'phone_number'
    ];

    public function doctors(){
        return $this->hasMany(Doctor::class, 'hospital_id', 'id');
    }

}
