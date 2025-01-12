<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{

    protected $table = 'readings';
    protected $primaryKey = 'readingId';

    protected $fillable = [
        'readingDeviceId',
        'readingTemperature', 
        'readingHumidity',
        'readingDate',
        'readingTime',
    ];
}
