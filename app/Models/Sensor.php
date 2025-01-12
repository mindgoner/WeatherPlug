<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $table = 'sensors';
    protected $primaryKey = 'sensorId';

    protected $fillable = [
        'deviceMac'
    ];

    public function readings(){
        return $this->hasMany(Reading::class, 'readingSensorId', 'sensorId');
    }
}
