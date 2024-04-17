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
            margin: 20px auto;
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
        button {
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
        button:hover {        
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
    </style>
@endsection

@section('content')
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Group Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <form method="POST" action="{{ route('sensor_groups.store') }}" class="inline-form">
                            @csrf
                            <div>
                                <label for="sensorGroupName">Nazwa grupy:</label>
                                <input type="text" name="sensorGroupName" id="sensorGroupName">
                            </div>
                    </td>
                    <td>
                        <button type="submit" class="button">Dodaj grupę</button>
                        </form>
                    </td> 
                </tr>
            </tbody>
        </table>
    </div>
@endsection