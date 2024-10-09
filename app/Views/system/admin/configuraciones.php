<?= $this->extend('template\main') ?>

<?= $this->section('content') ?>

<section class="flex flex-col gap-8 w-full">
    <h1 class="text-white text-6xl font-bold">Configuraciones</h1>
    
    <!-- Recurrencia de las reuniones -->
    <div class="mb-4">
        <label for="recurrencia" class="block mb-2  text-gray-900 dark:text-white">Recurrencia de las reuniones</label>
        <select id="recurrencia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5">
            <?php
            $opcionesRecurrencia = ['10', '20', '30', '40', '50', '60'];
            foreach ($opcionesRecurrencia as $opcion) {
                $selected = ($recurrencia == $opcion) ? 'selected' : '';
                echo "<option value=\"$opcion\" $selected>Cada $opcion minutos</option>";
            }
            ?>
        </select>
    </div>

    <!-- Configuración si los estudiantes pueden escoger horario -->
    <div class="flex items-center space-x-4">
        <input type="checkbox" id="escoger_horario" name="escoger_horario" <?= $escogerHorario ? 'checked' : '' ?> class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5">
        <label for="escoger_horario" class="text-white">Permitir a los estudiantes escoger su horario</label>
    </div>
    
    <!-- Configuración general de horario -->
    <div class="agenda py-6 px-2">
        <h3 class="text-white">Configuración de horario general</h3>
        <div class="flex items-center space-x-4 mt-6">
            <div>
                <label for="hora_inicio_general" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora de inicio</label>
                <input type="time" id="hora_inicio_general" name="hora_inicio_general" value="<?= $generalSchedule['hora_inicio'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5">
            </div>
            <div>
                <label for="hora_fin_general" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora de fin</label>
                <input type="time" id="hora_fin_general" name="hora_fin_general" value="<?= $generalSchedule['hora_fin'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5">
            </div>
        </div>
    </div>
    
    <div class="flex justify-end mt-4">
        <button id="guardarConfiguracion" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Guardar Configuración</button>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnGuardar = document.getElementById('guardarConfiguracion');
    btnGuardar.addEventListener('click', guardarConfiguracion);

    function guardarConfiguracion() {
        // Obtener la recurrencia
        const recurrenciaSelect = document.getElementById('recurrencia');
        const recurrencia = recurrenciaSelect.value;

        // Obtener las horas de inicio y fin
        const horaInicioInput = document.getElementById('hora_inicio_general');
        const horaFinInput = document.getElementById('hora_fin_general');

        const horaInicio = horaInicioInput.value;
        const horaFin = horaFinInput.value;

        const escogerHorario = document.getElementById('escoger_horario').checked;

        // Validar que las horas no estén vacías
        if (horaInicio === '' || horaFin === '') {
            alert('Por favor, completa las horas de inicio y fin.');
            return;
        }

        // Validar que la hora de inicio sea menor que la hora de fin
        if (horaInicio >= horaFin) {
            alert('La hora de inicio debe ser menor que la hora de fin.');
            return;
        }

        // Preparar los datos para enviar al backend
        const data = {
            recurrencia: recurrencia,
            escogerHorario: escogerHorario,
            horaInicio: horaInicio,
            horaFin: horaFin
        };

        // Hacer la llamada al endpoint
        fetch('<?= base_url('api/settings/guardar') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest' // Para indicar que es una solicitud AJAX
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert('Configuración guardada correctamente.');
            } else {
                alert('Error al guardar la configuración: ' + result.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error al guardar la configuración.');
        });
    }
});
</script>

<?= $this->endSection() ?>
