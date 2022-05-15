<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarUser extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function cars(){
        return $this->hasOne(Car::class,'id', 'car_id');
    }
}
