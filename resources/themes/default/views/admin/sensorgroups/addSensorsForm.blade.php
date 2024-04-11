@extends('layouts.panel')

@section('content')
<div class="pudelko">
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

@section('css')
<style>
    /* Dodaj style dla kontenera */
    .pudelko {
        width: 80%;
        margin: 20px auto;
        padding: 20px;
        margin-top:  120px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        background-color: #fff;
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
        border-radius: 4px;
    }
</style>
@endsection
