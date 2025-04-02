<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'dose', 'period'
    ];

    protected $casts = [
        'price' => 'double', 
        'dose' => 'integer'
    ];

    public function drugRecords(){
        return $this->hasMany(DrugRecord::class, 'drug_id', 'id');
    }
}
