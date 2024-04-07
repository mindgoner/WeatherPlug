<form method="POST" action="{{ route('sensor_groups.store') }}" style="margin-top: 20px;">
    @csrf

    <div style="margin-bottom: 10px;">
        <label for="sensorGroupName" style="font-weight: bold;">Nazwa grupy:</label>
        <input type="text" name="sensorGroupName" id="sensorGroupName" style="margin-left: 10px; padding: 5px;">
    </div>

    @auth
        <button type="submit" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px;">Dodaj grupę</button>
    @else
        <p style="color: red;">Musisz być zalogowany, aby dodać grupę sensorów.</p>
    @endauth
    
</form>