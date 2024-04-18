@extends('layouts.panel')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{url('css/group_edit.css') }}" rel="stylesheet">
    <link href="{{url('css/global.css') }}" rel="stylesheet">
</head>

@section('content')
<div class="container">
    <h1>Edit Sensor Group</h1>

    <form action="{{ route('sensor_groups.rename', $sensorGroup->id) }}" method="POST">
        @csrf
        @method('POST')

        <!-- Pole do zmiany nazwy grupy -->
        <div class="form-group">
            <label for="sensorGroupName">Group Name:</label>
            <input type="text" id="sensorGroupName" name="sensorGroupName" value="{{ $sensorGroup->sensorGroupName }}">
            <!-- Przycisk do zatwierdzenia zmian w nazwie grupy -->
            <button type="submit" class="button save-changes-button">Save Changes</button>
        </div>
    </form>

    <!-- Przypisany czujnik -->
    <div class="sensor-container">
        <h2>Assigned Sensor</h2>
        @if($sensors->isEmpty())
            <p class="no-sensor">No sensor assigned to this group.</p>
        @else
            <table class="sensor-table">
                <thead>
                    <tr>
                        <th class="header-cell">Device Mac</th>
                        <th class="header-cell">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sensors as $sensor)
                    <tr>
                        <td>{{ $sensor->deviceMac }}</td>
                        <td>
                        <form action="{{ route('sensor_groups.remove_sensor', ['id' => $sensor->id]) }}" method="POST" class="inline-form">
                                @csrf
                                @method('DELETE')
                                <input type='hidden' value="{{ $sensor->id }}" name="ToBeDelatedSensor" />
                                <button type="submit" class="remove-button">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    
</div>
@endsection
