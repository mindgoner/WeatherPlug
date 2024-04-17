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

        form.inline-form {
            display: inline-block;
            margin: 0;
        }
         button[type="submit"] {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s;
        }
         button:hover {
            background-color: #b22a2a;
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
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->autor_1()->name }}</td>
                        <td>
                            <!-- Dodaj przycisk usuwania dla każdego użytkownika -->
                            <form action="{{ route('delete_user', ['id' => $user->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"class="button">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
</div>
@endsection

