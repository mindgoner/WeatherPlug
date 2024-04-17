@extends('layouts.panel')

@section('css')
<style>
    /* Dodaj style do kontenera edycji grupy czujników */
    .container {
            width: 80%;
            margin: center;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-top:  72px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

    /* Styl nagłówka */
    h1 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
    }

    /* Styl tekstu, gdy brak przypisanego czujnika */
    .no-sensor {
        font-size: 18px;
        color: #777;
    }

    /* Styl tabeli */
    .sensor-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    /* Styl komórek nagłówka */
    .header-cell {
        background-color: #f2f2f2;
        font-weight: bold;
        padding: 10px 20px;
    }

    /* Styl komórek */
    td {
        padding: 10px 20px;
        border-bottom: 1px solid #ddd;
    }

    /* Styl komórek w ostatnim wierszu */
    tbody tr:last-child td {
        border-bottom: none;
    }

    /* Styl przycisku usuwania */
    .remove-button {
        background-color: #f44336;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 8px;
        transition: background-color 0.3s;
    }

    .remove-button:hover {
        background-color: #b22a2a;
    }

    /* Dodaj styl do przycisku "Save Changes" */
    .save-changes-button {
        display: inline-block;
        background-color: #4CAF50;
        color: white;
        padding: 5px 10px;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        margin-left: 10px; /* Add margin between buttons */
        border-radius: 8px;
        transition: background-color 0.3s; /* Smooth hover transition */
    }

    .save-changes-button:hover {
        background-color: #45a049; /* Ciemniejszy odcień zielonego */
    }
</style>
@endsection

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
