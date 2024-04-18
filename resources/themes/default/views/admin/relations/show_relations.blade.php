@extends('layouts.panel')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{url('css/relations_show.css') }}" rel="stylesheet">
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

