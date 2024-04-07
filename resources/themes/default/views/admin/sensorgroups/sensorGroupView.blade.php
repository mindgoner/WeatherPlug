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
                        <!-- Formularz usuwania dla każdej grupy czujników -->
                        <form action="{{ route('sensor_groups.destroy', $sensorGroup->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type='hidden' value="{{ $sensorGroup->id }}" name="ToBeDelated" />
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection