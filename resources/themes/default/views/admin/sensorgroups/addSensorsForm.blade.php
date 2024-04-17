@extends('layouts.panel')


@section('css')
<style>
    /* Dodaj style dla kontenera */
    .container {
            width: 80%;
            margin: center ;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-top:  72px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

    /* Dodaj style dla nagłówka */
    h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    /* Dodaj style dla podtytułu */
    .subheading {
        margin-left: 20px;
        margin-bottom: 10px;
    }
    tr:hover {
        background-color: #ddd;
     }

    /* Dodaj style dla tabeli */
    .sensor-table {
        width: 100%;
        border-collapse: collapse;
    }

    /* Dodaj style dla komórek tabeli */
    .sensor-table th,
    .sensor-table td {
        padding: 10px;
        border: 1px solid #ddd;
    }

    /* Dodaj style dla przycisków */
    .button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        border-radius: 8px;
        transition: background-color 0.3s; /* Smooth hover transition */
    }
    .button:hover {
        background-color: #45a049; /* Ciemniejszy odcień zielonego */
    }
</style>
@endsection

@section('content')
<div class="container">
    <h1>Add Sensors to Group</h1>

    <h2 class="subheading">Available Sensors:</h2>
    <table class="sensor-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
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


