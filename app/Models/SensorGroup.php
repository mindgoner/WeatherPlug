<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorGroup extends Model
{
    protected $table = 'sensorgroups';
    use HasFactory;
    protected $fillable = [
        'id',
        'sensorGroupName',
        'sensorGroupOwner',
        
    ];
    public function autor(){
        return User::where('id',$this->sensorGroupOwner)->first();
    }

    

    
}
