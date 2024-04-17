@extends('layouts.panel')


@section('css')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            
            
        }
        .container {
            width: 80%;
            margin: center;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-top:  72px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        tr:hover {
            background-color: #ddd;
        }
        a.button {
             display: inline-block;
             background-color: #4CAF50;
             color: white;
             padding: 10px 20px;
             text-align: center;
             text-decoration: none;
             font-size: 16px;
             margin-right: 10px; /* Add margin between buttons */
             border-radius: 8px;
             transition: background-color 0.3s; /* Smooth hover transition */
             
        }
        a.button:hover {        
            background-color: #45a049; /* Darker color on hover */
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
            border-radius: 8px;
            transition: background-color 0.3s;
        }
        form.inline-form button:hover {
            background-color: #b22a2a;
        }

        .create-button {
            border: none;
            background-color: #4CAF50;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 10px;
            font-size: 16px;
            border-radius: 8px;
            color: white;
            transition: background-color 0.3s
        }
        .create-button:hover {
             background-color: #005f7e;
        }
        
    </style>
@endsection

@section('content')

<div class="container">
    <h1>Sensor Groups</h1>
    <a href="{{ route('sensor_groups.create') }}" class=" create-button">Create New Sensor Group</a>
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
                <th>Edit functions</th>
                <th>Add functions</th>
                <th>Show functions</th>
                <th>Delate</th> <!-- Dodaj kolumnę z działaniami -->
            </tr>
            </thead>
            <tbody>
            @foreach($sensorGroups as $sensorGroup)
                <tr>
                    <td>{{ $sensorGroup->id }}</td>
                    <td>{{ $sensorGroup->sensorGroupName }}</td>
                    <td>{{ $sensorGroup->autor()->name }}</td>
                    <td>{{ $sensorGroup->created_at }}</td>
                    <!-- Przyciski działań: Edycja --> 
                    <td>
                    <a href="{{ route('sensor_groups.edit', ["id" =>$sensorGroup->id]) }}" class="button">Edit Group</a>
                    <a href="{{ route('relations.show_members',["id" =>$sensorGroup->id])}}" class="button">Edit members</a>
                    </td>
                    <!-- Przyciski działań: Dodawanie --> 
                    <td>
                    <a href="{{ route('relations.show',["id" =>$sensorGroup->id])}}" class="button">Add member</a>
                    <a href="{{ route('sensor_groups.add_sensors_form', $sensorGroup->id) }}" class="button">Add Sensors</a>
                    </td>
                    <!-- Przyciski działań: Widok --> 
                    <td>
                    <a href="{{ route('sensor_groups.show_added_sensors', $sensorGroup->id) }}" class="button">Show Added Sensors</a>  
                    </td>
                    <!-- Przyciski działań: Usuwanie --> 
                    <td>
                    <form action="{{ route('sensor_groups.destroy', $sensorGroup->id) }}" method="POST" class="inline-form">
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

