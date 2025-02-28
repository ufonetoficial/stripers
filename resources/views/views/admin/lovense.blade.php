@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Control de Dispositivos Lovense</h2>

    <div id="lovense-controls">
        <label for="device-select">Selecciona un dispositivo:</label>
        <select id="device-select">
            @foreach($devices as $device)
                <option value="{{ $device->id }}">{{ $device->device_name }} ({{ $device->price_per_minute }} / min)</option>
            @endforeach
        </select>

        <label for="activation-duration">Duración (segundos):</label>
        <input type="number" id="activation-duration" min="10" max="300" step="10" value="60">

        <button id="activate-device" class="btn btn-primary mt-3">Activar</button>
    </div>

    <div id="activation-status" class="mt-3"></div>
    <div id="live-notifications" class="mt-3"></div>
</div>

<div class="container mt-5">
    <h3>Historial de Activaciones</h3>
    <ul id="activation-history">
        @foreach($activations as $activation)
            <li>{{ $activation->user_name }} activó {{ $activation->device_name }} por {{ $activation->duration }} segundos ({{ $activation->amount }} créditos)</li>
        @endforeach
    </ul>
</div>

<script>
    document.getElementById('activate-device').addEventListener('click', function() {
        const deviceId = document.getElementById('device-select').value;
        const duration = document.getElementById('activation-duration').value;

        if(duration > 300) {
            alert('La duración máxima permitida es de 300 segundos.');
            return;
        }

        fetch("{{ route('user.lovense.activate') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                device_id: deviceId,
                duration: duration
            })
        })
        .then(response => response.json())
        .then(data => {
            const statusDiv = document.getElementById('activation-status');
            if(data.success) {
                statusDiv.innerHTML = `<div class="alert alert-success">${data.success}</div>`;

                // Emitir notificación en tiempo real
                Echo.channel('lovense-activations')
                    .whisper('activation', {
                        message: `El dispositivo ha sido activado por ${data.user_name} durante ${duration} segundos.`
                    });
            } else {
                statusDiv.innerHTML = `<div class="alert alert-danger">${data.error}</div>`;
            }
        })
        .catch(error => console.error('Error:', error));
    });

    // Escuchar notificaciones en tiempo real
    Echo.channel('lovense-activations')
        .listenForWhisper('activation', (e) => {
            const notificationsDiv = document.getElementById('live-notifications');
            const newNotification = document.createElement('div');
            newNotification.classList.add('alert', 'alert-info', 'fade-in');
            newNotification.textContent = e.message;
            notificationsDiv.appendChild(newNotification);

            // Eliminar la notificación después de 5 segundos
            setTimeout(() => {
                newNotification.classList.add('fade-out');
                setTimeout(() => newNotification.remove(), 1000);
            }, 5000);
        });
</script>

<style>
    /* Animaciones para notificaciones */
    .fade-in {
        animation: fadeIn 0.5s forwards;
    }

    .fade-out {
        animation: fadeOut 1s forwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
</style>
@endsection
