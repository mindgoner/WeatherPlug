@extends('layouts.panel')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{url('css/realtions_edit.css') }}" rel="stylesheet">
    <link href="{{url('css/global.css') }}" rel="stylesheet">
</head>

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

