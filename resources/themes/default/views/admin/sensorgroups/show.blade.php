@extends('layouts.panel')

@section('css')
<style>
    /* Dodaj style do kontenera sensorów */
    .container {
        width: 80%;
        margin: center;
        margin-top:  120px;
        padding: 20px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Styl nagłówka */
    h1 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
    }

    /* Styl tekstu, gdy brak dodanych sensorów */
    .no-sensors {
        font-size: 18px;
        color: #777;
    }

    /* Styl tabeli */
    .sensor-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }


        tr:hover {
            background-color: #ddd;
        }

    /* Styl komórek nagłówka */
    .header-cell {
        background-color: #f2f2f2;
        font-weight: bold;
        padding: 10px 20px;
    }

    /* Styl komórek */
    td {
        padding: 10px 20px;
        border-bottom: 1px solid #ddd;
    }

    /* Styl komórek w ostatnim wierszu */
    tbody tr:last-child td {
        border-bottom: none;
    }

    /* Styl rozwijanego menu */
    .dropdown-menu {
        display: none;
        position: absolute;
        background-color: #fff;
        min-width: 120px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        z-index: 1;
      
    }

    /* Styl linku w rozwijanym menu */
    .dropdown-menu a {
        color: #333;
        padding: 10px;
        text-decoration: none;
        display: block;
        
    }

    /* Styl linku w rozwijanym menu po najechaniu */
    .dropdown-menu a:hover {
        background-color: #f2f2f2;
    }

    /* Styl komórki z rozwijanym menu */
    .dropdown:hover .dropdown-menu {
        display: block;
    }
</style>
@endsection

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
