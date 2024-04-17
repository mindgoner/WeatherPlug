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
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        button {
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
            border-radius: 8px;
            transition: background-color 0.3s; /* Smooth hover transition */
        }
        button:hover {        
            background-color: #45a049; /* Darker color on hover */
        }

    </style>
@endsection


@section('content')
<div class="container">
    <h1>All Users</h1>
    @if ($users->isEmpty())
        <p class="no-users">No users found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>
                        <form action="{{ route('relations.add') }}" method="POST" class="inline-form">
                            @csrf
                            <input type="hidden" name="userId" value="{{ $user->id }}">
                            <input type="hidden" name="groupId" value="{{ $id }}">
                            <button type="submit" class="button">Add Group</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
</div>
@endsection

