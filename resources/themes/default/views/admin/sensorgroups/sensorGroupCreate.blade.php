@extends('layouts.panel')


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{url('css/group_create.css') }}" rel="stylesheet">
</head>

@section('content')
    <div class="container">
    <h1>Sensor Group Crate</h1>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <form method="POST" action="{{ route('sensor_groups.store') }}" class="inline-form">
                            @csrf
                            <div>
                                <label for="sensorGroupName" >Group Name:</label>
                                <input type="text" name="sensorGroupName" id="sensorGroupName">
                            </div>
                    </td>
                    <td>
                        <button type="submit" class="button">Add Group</button>
                        </form>
                    </td> 
                </tr>
            </tbody>
        </table>
    </div>
@endsection