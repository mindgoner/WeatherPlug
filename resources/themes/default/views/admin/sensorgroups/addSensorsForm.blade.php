@extends('layouts.panel')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{url('css/group.css') }}" rel="stylesheet">
    <link href="{{url('css/global.css') }}" rel="stylesheet">
</head>

@section('content')
<div class="container">
    <h1>Add Sensors to Group</h1>
    <h2 class="subheading">Available Sensors:</h2>
    <table class="sensor-table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        <tbody>
            @foreach($availableSensors as $sensor)
            <tr>
                <td>{{ $sensor->id }}</td>
                <td>{{ $sensor->deviceMac }}</td>
                <td>
                    <form action="{{ route('sensor_groups.add_sensors', $sensorGroup->id) }}" method="POST" class="inline-form">
                        @csrf
                        <input type="hidden" name="sensor_id" value="{{ $sensor->id }}">
                        <button type="submit" class="button">Add to Group</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


