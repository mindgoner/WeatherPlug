<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use App\Models\Reading;
use App\Http\Requests\StoreReadingRequest;
use App\Http\Requests\GetReadingsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReadingController extends Controller
{

    public function store(StoreReadingRequest $Request)
    {
        $ValidatedData = $Request->validated();

        $Sensor = Sensor::where('deviceMac', $ValidatedData['deviceMac'])->first();
        if(!$Sensor){
            $Sensor = new Sensor();
            $Sensor->deviceMac = $ValidatedData['deviceMac'];
            $Sensor->save();
        }

        $Reading = new Reading();
        $Reading->readingSensorId = $Sensor->sensorId;
        $Reading->readingTemperature = $ValidatedData['temperature'];
        $Reading->readingHumidity = $ValidatedData['humidity'] ?? null;
        $Reading->readingDate = date('Y-m-d');
        $Reading->readingTime = date("H:i:s");
        $Reading->save();

        return response()->json([
            'success' => true,
            'message' => 'Reading stored successfully',
        ]);
    }

    public function readings($sensorId, GetReadingsRequest $Request){

        $Sensor = Sensor::where('sensorId', $sensorId)->first();
        if(!$Sensor){
            return response()->json([
                'success' => false,
                'message' => 'Sensor not found',
            ], 404);
        }

        $ValidatedData = $Request->validated();
        $Readings = $Sensor->readings()
            ->select('readingTemperature', 'readingHumidity', 'readingDate', 'readingTime')
            ->orderBy('readingDate', 'DESC')
            ->orderBy('readingTime', "DESC");

        if(isset($ValidatedData['from'])){
            $Readings->where('readingDate', '>=', $ValidatedData['from']);
        }
        if(isset($ValidatedData['to'])){
            $Readings->where('readingDate', '<=', $ValidatedData['to']);
        }
        if(isset($ValidatedData['limit'])){
            $Readings->limit($ValidatedData['limit']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Sensor readings retrieved successfully',
            'data' => $Readings->get(),
        ]);

    }

    public function avgReadings($sensorId, GetReadingsRequest $Request)
    {
        $Sensor = Sensor::where('sensorId', $sensorId)->first();
        if (!$Sensor) {
            return response()->json([
                'success' => false,
                'message' => 'Sensor not found',
            ], 404);
        }

        $ValidatedData = $Request->validated();

        $mode = $ValidatedData['mode'] ?? 'd'; // Default to daily if no mode provided

        // Define the grouping format based on the mode
        $groupFormat = match ($mode) {
            'i' => '%Y-%m-%d %H:%i', // Group by minutes
            'h' => '%Y-%m-%d %H:00', // Group by hours
            'd' => '%Y-%m-%d',       // Group by days
            'w' => '%x-%v',          // Group by weeks (ISO week year-week)
            'm' => '%Y-%m',          // Group by months
            'y' => '%Y',             // Group by years
            default => '%Y-%m-%d',   // Default to daily if mode is invalid
        };

        $Readings = $Sensor->readings()
            ->select(
                DB::raw("DATE_FORMAT(CONCAT(readingDate, ' ', readingTime), '$groupFormat') as period"),
                DB::raw('AVG(readingTemperature) as avgTemperature'),
                DB::raw('AVG(readingHumidity) as avgHumidity')
            )
            ->groupBy('period')
            ->orderBy('period', 'DESC');

        if (isset($ValidatedData['from'])) {
            $Readings->where('readingDate', '>=', $ValidatedData['from']);
        }
        if (isset($ValidatedData['to'])) {
            $Readings->where('readingDate', '<=', $ValidatedData['to']);
        }
        if (isset($ValidatedData['limit'])) {
            $Readings->limit($ValidatedData['limit']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Average sensor readings retrieved successfully',
            'data' => $Readings->get(),
        ]);
    }

    public function chart($sensorId, Request $Request){
        $limit = $Request->input('limit');
        return view('readings.chart', [
            'sensorId' => $sensorId,
            'limit' => $limit ?? 20,
        ]);
    }

    public function averageChart($sensorId, Request $Request){
        $mode = $Request->input('mode');
        $limit = $Request->input('limit');
        return view('readings.avg-chart', [
            'sensorId' => $sensorId,
            'mode' => $mode,
            'limit' => $limit ?? 3600,
        ]);
    }
}
