@extends('layouts.panel')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{url('css/show.css') }}" rel="stylesheet">
    <link href="{{url('css/global.css') }}" rel="stylesheet">
</head>
@section('content')
<div class="container">
    <h1>Added Sensors</h1>

    @if($sensors->isEmpty())
    <p class="no-sensors">No sensors added.</p>
    @else
    <table class="sensor-table">
        <thead>
            <tr>
                <th class="header-cell">Device Mac</th>
                <th class="header-cell">Belongs To</th>
                <th class="header-cell">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sensors as $sensor)
            <tr>
                <td>{{ $sensor->deviceMac }}</td>
                <td>{{ $sensor->sensorBelongsTo }}</td>
                <td class="dropdown">
                    <span>Pomiary</span>
                    <div class="dropdown-menu">
                        <a href="{{ url('/wykres?deviceId=' . $sensor->id . '&display=[%22Cisnienie%22]') }}">Ciśnienie</a>
                        <a href="{{ url('/wykres?deviceId=' . $sensor->id . '&display=[%22Temperatura%22]') }}">Temperatura</a>
                        <a href="{{ url('/wykres?deviceId=' . $sensor->id . '&display=[%22Wilgotnosc%22]') }}">Wilgotność</a>
                        <a href="{{ url('/wykres?deviceId=' . $sensor->id . '&display=[%22Temperatura%22%2C%22Cisnienie%22%2C%22Wilgotnosc%22]') }}">Wszystko</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection

@section('scripts')
<script>
    // Dodaj obsługę zdarzenia kliknięcia dla rozwijanego menu
    document.addEventListener('DOMContentLoaded', function () {
        const dropdowns = document.querySelectorAll('.dropdown');

        dropdowns.forEach(function (dropdown) {
            dropdown.addEventListener('click', function () {
                // Pobierz rozwijane menu wewnątrz klikniętej komórki
                const menu = dropdown.querySelector('.dropdown-menu');

                // Zmień widoczność menu
                if (menu.style.display === 'block') {
                    menu.style.display = 'none';
                } else {
                    menu.style.display = 'block';
                }
            });
        });
    });
</script>
@endsection
