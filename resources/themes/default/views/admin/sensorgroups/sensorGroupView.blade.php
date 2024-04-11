@extends('layouts.panel')

@section('css')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .pudelko {
            width: 80%;
            margin-left: 20px;
            margin-right: 20px;
            margin-top:  72px;
            padding: 20px;
        }
        h1 {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        a.button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
        }
        form.inline-form {
            display: inline-block;
            margin: 0;
        }
        form.inline-form button[type="submit"] {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
@endsection

@section('content')

<div class="pudelko">
    <h1>Sensor Groups</h1>

    <a href="{{ route('sensor_groups.create') }}" class="button">Create New Sensor Group</a>

    @if($sensorGroups->isEmpty())
        <p>No sensor groups found.</p>
    @else
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Owner</th>
                <th>Created At</th>
                <th>Actions</th> <!-- Dodaj kolumnę z działaniami -->
            </tr>
            </thead>
            <tbody>
            @foreach($sensorGroups as $sensorGroup)
                <tr>
                    <td>{{ $sensorGroup->id }}</td>
                    <td>{{ $sensorGroup->sensorGroupName }}</td>
                    <td>{{ $sensorGroup->autor()->name }}</td>
                    <td>{{ $sensorGroup->created_at }}</td>
                    <td>
                        <!-- Przyciski działań: Usuwanie, Edycja, Dodawanie sensorów -->
                        <form action="{{ route('sensor_groups.destroy', $sensorGroup->id) }}" method="POST" class="inline-form">
                            @csrf
                            @method('DELETE')
                            <input type='hidden' value="{{ $sensorGroup->id }}" name="ToBeDelated" />
                            <button type="submit">Delete</button>
                        </form>
                        <a href="{{ route('sensor_groups.edit', ["id" =>$sensorGroup->id]) }}" class="button">Edit</a>
                        <a href="{{ route('sensor_groups.add_sensors_form', $sensorGroup->id) }}" class="button">Add Sensors</a>
                        <a href="{{ route('sensor_groups.show_added_sensors', $sensorGroup->id) }}" class="button">Show Added Sensors</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection

