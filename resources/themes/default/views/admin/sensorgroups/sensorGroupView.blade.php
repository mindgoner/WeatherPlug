@extends('layouts.panel')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{url('css/group_view.css') }}" rel="stylesheet">
    <link href="{{url('css/global.css') }}" rel="stylesheet">
</head>

@section('content')
<div class="container">
    <h1>Sensor Groups</h1>
    <a href="{{ route('sensor_groups.create') }}" class=" create-button">Create New Sensor Group</a>
    @if($sensorGroups->isEmpty())
        <p>No sensor groups found.</p>
    @else
        <table>
   
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

