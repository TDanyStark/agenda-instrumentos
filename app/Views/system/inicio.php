<?= $this->extend('template\main') ?>

<?= $this->section('content') ?>
<h1 class="text-white text-6xl font-bold">Inicio</h1>

<style>
  .schedule-container {
    position: relative;
    width: 100%;
  }

  .time-labels {
    position: absolute;
    left: 0;
    top: 20px;
    width: 50px;
  }

  .time-labels div {
    position: relative;
    height: 60px;
    text-align: right;
    padding-right: 15px;
    box-sizing: border-box;
    color: #cfcfcf;
    font-size: 14px;
  }

  .time-labels div::after {
    content: '';
    display: block;
    top: 10px;
    right: 0;
    width: 7px;
    height: 1px;
    background-color: #fff;
    position: absolute;
    bottom: 0;
  }

  .days {
    margin-left: 50px;
    display: flex;
    border-top: 1px solid #ccc;
  }

  .day {
    flex: 1;
    border-right: 1px solid #ccc;
    position: relative;
  }

  .day:first-child {
    border-left: 1px solid #ccc;
  }


  .day-header {
    height: 30px;
    background-color: #f0f0f0;
    text-align: center;
    line-height: 30px;
    border-bottom: 1px solid #ccc;
    font-weight: bold;
  }

  .day-content {
    position: relative;
  }

  .time-slot {
    height: 60px;
    border-bottom: 1px solid #eee;
  }

  .current-time-indicator {
    position: absolute;
    height: 2px;
    background-color: red;
    z-index: 1;
  }

  .current-time-indicator::before {
    content: '';
    position: absolute;
    top: -4px;
    left: -5px;
    width: 10px;
    height: 10px;
    background-color: red;
    border-radius: 50%;
  }

  /* ... Estilos anteriores ... */

  .occupied-slot {
    cursor: pointer;
    position: absolute;
    left: 0;
    right: 0;
    background-color: rgba(0, 128, 255, 0.9);
    /* Color semitransparente */
    color: #fff;
    border-radius: 4px;
    border: 1px solid black;
    overflow: hidden;
    font-size: 12px;
  }

  /* Estilos para el contenido dentro de los slots */
  .slot-info {
    display: flex;
    flex-direction: column;
    height: 100%;
    padding: 5px;
    box-sizing: border-box;
  }


  /* Estilos específicos para cada elemento */
  .slot-estudiante,
  .slot-profesor,
  .slot-salon,
  .slot-horas {
    font-size: 12px;
    color: #fff;
  }

  .filters {
    margin-bottom: 20px;
  }

  .filter-controls {
    display: flex;
    align-items: center;
    gap: 20px;
  }

  .filter-controls label {
    margin-right: 5px;
    color: #fff;
  }

  .filter-controls select {
    padding: 5px;
  }
</style>


<section class="mt-10">
  <div class="filters mt-6">
    <h2 class="text-gray-400 text-2xl">Filtrar por:</h2>
    <div class="filter-controls mt-4">
      <label for="filter-salon">Salón:</label>
      <select id="filter-salon">
        <option value="<?= $salonDefault ?>">Por defecto </option>
        <!-- Opciones dinámicas -->
      </select>

      <!-- Campo de búsqueda para estudiantes -->
      <label for="student-search-input">Buscar Estudiante:</label>
      <input type="text" id="student-search-input" list="student-results" />
      <datalist id="student-results">
        <!-- Los resultados de la búsqueda se insertarán aquí -->
      </datalist>

      <!-- Campo de búsqueda para profesores -->
      <label for="professor-search-input">Buscar Profesor:</label>
      <input type="text" id="professor-search-input" list="professor-results" />
      <datalist id="professor-results">
        <!-- Los resultados de la búsqueda se insertarán aquí -->
      </datalist>

      <button id="limpiar" class="py-2 px-4 bg-primary text-white">Limpiar filtros</button>
    </div>
    <button id="download-schedule" class="py-2 px-4 bg-green-500 text-white mt-4">Descargar Horario como JPG</button>
  </div>

  <div id="screen-horario">
    <div class="my-6">
      <h2 class="text-white text-2xl">Horario:</h2>
      <p id="horario" class="text-white text-xl"></p>
    </div>
    <div class="schedule-container mt-6">
      <div class="time-labels">
        <!-- Etiquetas de tiempo -->
      </div>
      <div class="days">
        <!-- Columnas de días -->
      </div>
      <div class="current-time-indicator" id="current-time-indicator"></div>
    </div>
  </div>

  <!-- Main modal -->
  <div id="slot-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
            Detalles del Slot
          </h3>
          <button id="close-modal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <div id="modal-body" class="p-4 md:p-5 space-y-4 text-white">

        </div>
      </div>
    </div>
  </div>

</section>


<script>
  const scheduleContainer = document.querySelector('.schedule-container');
  const timeLabels = document.querySelector('.time-labels');
  const daysContainer = document.querySelector('.days');
  const currentTimeIndicator = document.getElementById('current-time-indicator');
  const horario = document.getElementById('horario');

  // Referencias a los selectores de filtros
  const filterSalon = document.getElementById('filter-salon');

  let HOUR_START = <?= json_encode($horaInicio) ?>; // "07:00"
  let HOUR_END = <?= json_encode($horaFin) ?>; // "21:00"
  // pasar el texto a horas
  HOUR_START = parseInt(HOUR_START.split(':')[0]);
  HOUR_END = parseInt(HOUR_END.split(':')[0]);

  const cantidadHorasTotal = (HOUR_END - HOUR_START) * 60;

  const daysOfWeek = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];

  // Mapeo de días a índices
  const dayIndexMap = {
    "Lunes": 0,
    "Martes": 1,
    "Miércoles": 2,
    "Miercoles": 2,
    "Jueves": 3,
    "Viernes": 4,
    "Sábado": 5,
    "Sabado": 5
  };

  // Convertir los datos de PHP a JavaScript
  let horarios = <?= json_encode($horarios) ?>;

  // Datos para los filtros
  const salonesData = <?= json_encode($salones) ?>;

  // Mapear los datos para los filtros
  const salones = salonesData.map(salon => ({
    id: salon.RoomID,
    name: salon.RoomName
  }));


  // Generar etiquetas de tiempo
  for (let hour = HOUR_START; hour <= HOUR_END; hour++) {
    const timeLabel = document.createElement('div');
    timeLabel.textContent = hour + ':00';
    timeLabels.appendChild(timeLabel);
  }

  // Generar columnas de días y slots de tiempo
  daysOfWeek.forEach((day, index) => {
    const dayColumn = document.createElement('div');
    dayColumn.classList.add('day');

    const dayHeader = document.createElement('div');
    dayHeader.classList.add('day-header');
    dayHeader.textContent = day;
    dayColumn.appendChild(dayHeader);

    const dayContent = document.createElement('div');
    dayContent.classList.add('day-content');
    dayColumn.appendChild(dayContent);

    for (let hour = HOUR_START; hour < HOUR_END; hour++) {
      const timeSlot = document.createElement('div');
      timeSlot.classList.add('time-slot');
      dayContent.appendChild(timeSlot);
    }

    daysContainer.appendChild(dayColumn);
  });

  function updateCurrentTimeIndicator() {
    const now = new Date();
    const currentDay = now.getDay(); // Domingo es 0, Lunes es 1
    const currentHour = now.getHours();
    const currentMinutes = now.getMinutes();
    const currentDayIndex = currentDay === 0 ? 6 : currentDay - 1; // Ajuste para domingo

    // Obtener la altura de los slots de tiempo
    const dayColumn = document.querySelector('.day');
    const dayContent = dayColumn.querySelector('.day-content');
    const scheduleHeight = dayContent.offsetHeight;

    // Calcular posición vertical
    const totalMinutes = ((currentHour - HOUR_START) * 60) + currentMinutes;
    const totalScheduleMinutes = cantidadHorasTotal; // De 7 AM a 8 PM

    let topPosition = (totalMinutes / totalScheduleMinutes) * scheduleHeight;
    topPosition = Math.max(0, Math.min(topPosition, scheduleHeight));

    // Ajustar la posición del indicador
    const dayHeaderHeight = dayColumn.querySelector('.day-header').offsetHeight;
    currentTimeIndicator.style.top = dayContent.offsetTop + topPosition + 'px';

    // Calcular posición horizontal
    const dayWidth = daysContainer.offsetWidth / 6;
    const leftPosition = dayWidth * currentDayIndex + timeLabels.offsetWidth;

    currentTimeIndicator.style.left = leftPosition + 'px';
    currentTimeIndicator.style.width = dayWidth + 'px';
  }

  // Función para convertir hora a minutos desde las 8 AM
  function timeToMinutes(timeStr) {
    const [hours, minutes] = timeStr.split(':').map(Number);
    return (hours - HOUR_START) * 60 + minutes;
  }

  // Función para agregar slots ocupados
  function addOccupiedSlots() {
    // Primero, limpiar los slots existentes
    document.querySelectorAll('.occupied-slot').forEach(slot => slot.remove());

    horarios.forEach(slot => {
      const dayIndex = dayIndexMap[slot.dia];
      if (dayIndex === undefined) return; // Si el día no existe, omitimos este slot

      const dayColumn = daysContainer.children[dayIndex];
      const dayContent = dayColumn.querySelector('.day-content');

      // Calcular posición y tamaño
      const startMinutes = timeToMinutes(slot.hora_inicio);
      const endMinutes = timeToMinutes(slot.hora_fin);
      const slotDuration = endMinutes - startMinutes;

      const totalScheduleMinutes = cantidadHorasTotal; // De 7 AM a 8 PM
      const scheduleHeight = dayContent.offsetHeight;

      const topPosition = (startMinutes / totalScheduleMinutes) * scheduleHeight;
      const slotHeight = (slotDuration / totalScheduleMinutes) * scheduleHeight;

      // Crear el elemento del slot ocupado
      const occupiedSlot = document.createElement('div');
      occupiedSlot.classList.add('occupied-slot');
      occupiedSlot.style.top = topPosition + 'px';
      occupiedSlot.style.height = slotHeight + 'px';

      // Crear el contenido del slot
      const slotInfo = document.createElement('div');
      slotInfo.classList.add('slot-info');

      // Añadir el estudiante
      const estudianteElem = document.createElement('div');
      estudianteElem.classList.add('slot-estudiante');
      estudianteElem.textContent = `Estudiante: ${slot.estudiante}`;
      slotInfo.appendChild(estudianteElem);

      // Añadir el profesor
      const profesorElem = document.createElement('div');
      profesorElem.classList.add('slot-profesor');
      profesorElem.textContent = `Profesor: ${slot.profesor}`;
      slotInfo.appendChild(profesorElem);

      // Añadir el salón
      const salonElem = document.createElement('div');
      salonElem.classList.add('slot-salon');
      salonElem.textContent = `Salón: ${slot.salon}`;
      slotInfo.appendChild(salonElem);

      // Añadir las horas
      const horasElem = document.createElement('div');
      horasElem.classList.add('slot-horas');
      horasElem.textContent = `${slot.hora_inicio} - ${slot.hora_fin}`;
      slotInfo.appendChild(horasElem);

      // Agregar el contenido al slot ocupado
      occupiedSlot.appendChild(slotInfo);

      // Agregar el slot al contenido del día
      dayContent.appendChild(occupiedSlot);
    });
  }

  function handleFilterChange() {
    let selectedSalonID = filterSalon.value;
    let selectedEstudianteName = studentSearchInput.value;
    let selectedProfesorName = professorSearchInput.value;

    let selectedSalonName = '';
    let selectedEstudianteID = '';
    let selectedProfesorID = '';

    // Obtener el nombre del salón seleccionado
    if (selectedSalonID) {
      let selectedSalonOption = filterSalon.options[filterSalon.selectedIndex];
      selectedSalonName = selectedSalonOption.textContent;
    }

    // Para el estudiante, buscar la opción coincidente en el datalist
    if (selectedEstudianteName) {
      let options = studentResultsContainer.options;
      for (let i = 0; i < options.length; i++) {
        if (options[i].value === selectedEstudianteName) {
          selectedEstudianteID = options[i].dataset.id;
          break;
        }
      }
    }

    // Para el profesor
    if (selectedProfesorName) {
      let options = professorResultsContainer.options;
      for (let i = 0; i < options.length; i++) {
        if (options[i].value === selectedProfesorName) {
          selectedProfesorID = options[i].dataset.id;
          break;
        }
      }
    }

    // Si se selecciona un estudiante o profesor, limpiar la selección de salón
    if (selectedEstudianteID || selectedProfesorID) {
      selectedSalonID = '';
      filterSalon.value = 4;
      selectedSalonName = '';
    }

    // Actualizar el elemento 'horario'
    if (selectedEstudianteName) {
      horario.textContent = `Estudiante ${selectedEstudianteName}`;
    } else if (selectedProfesorName) {
      horario.textContent = `Profesor ${selectedProfesorName}`;
    } else if (selectedSalonName) {
      horario.textContent = `Salón ${selectedSalonName}`;
    } else {
      horario.textContent = '';
    }

    // Construir la URL con los parámetros de los filtros
    const url = new URL('<?= base_url('inicio/getFilteredSchedules') ?>');
    const params = new URLSearchParams();

    if (selectedSalonID) params.append('roomID', selectedSalonID);
    if (selectedEstudianteID) params.append('studentID', selectedEstudianteID);
    if (selectedProfesorID) params.append('professorID', selectedProfesorID);

    url.search = params.toString();

    // Realizar la solicitud AJAX
    fetch(url)
      .then(response => response.json())
      .then(data => {
        horarios = data;
        addOccupiedSlots();
      })
      .catch(error => {
        console.error('Error al obtener los horarios filtrados:', error);
      });
  }


  // Agregar eventos de cambio a los filtros
  filterSalon.addEventListener('change', handleFilterChange);


  // Función para poblar las opciones de los filtros
  function populateFilterOptions() {
    // Añadir opciones al selector de salones
    salones.forEach(salon => {
      const option = document.createElement('option');
      option.value = salon.id;
      option.textContent = salon.name;
      filterSalon.appendChild(option);
    });
  }


  // Function to search entities via API
  async function searchEntities(entityType, query, resultsContainer, inputType) {
    try {
      const response = await fetch(`<?= base_url('api/search') ?>/${entityType}?q=${encodeURIComponent(query)}`);
      if (!response.ok) {
        throw new Error('Error al buscar');
      }
      const result = await response.json();
      const data = result.data;
      displayResults(data, resultsContainer, inputType);
    } catch (error) {
      console.error(error);
    }
  }

  function displayResults(data, resultsContainer, inputType) {
    // Limpiar resultados anteriores
    resultsContainer.innerHTML = '';
    data.forEach(item => {
      const option = document.createElement('option');
      option.value = inputType === 'students' ? item.name : item.Name;
      option.dataset.id = inputType === 'students' ? item.id : item.ProfessorID;
      resultsContainer.appendChild(option);
    });
  }


  // Ejemplo de uso para buscar estudiantes
  const studentSearchInput = document.getElementById('student-search-input');
  const studentResultsContainer = document.getElementById('student-results');

  studentSearchInput.addEventListener('input', function() {
    const query = this.value;
    if (query.length >= 3) {
      searchEntities('students', query, studentResultsContainer, 'students');
    }
  });

  // Ejemplo de uso para buscar profesores
  const professorSearchInput = document.getElementById('professor-search-input');
  const professorResultsContainer = document.getElementById('professor-results');

  professorSearchInput.addEventListener('input', function() {
    const query = this.value;
    if (query.length >= 3) {
      searchEntities('professors', query, professorResultsContainer, 'professors');
    }
  });

  // Para el campo de estudiantes
  studentSearchInput.addEventListener('change', function() {
    handleFilterChange();
  });

  professorSearchInput.addEventListener('change', function() {
    handleFilterChange();

  });

  const limpiarButton = document.getElementById('limpiar');

  limpiarButton.addEventListener('click', function() {
    filterSalon.value = 4;
    studentSearchInput.value = '';
    professorSearchInput.value = '';
    horario.textContent = ''; // Restablecer el contenido

    handleFilterChange();
  });


  // Llamar a la función para poblar las opciones de los filtros
  populateFilterOptions();

  // Llamar a la función para agregar slots ocupados
  addOccupiedSlots();

  // Código para actualizar el indicador de tiempo actual
  updateCurrentTimeIndicator();
  setInterval(updateCurrentTimeIndicator, 10000); // Actualizar cada 10 segundosP

  // --- Lógica del Modal ---
  document.addEventListener('click', function(event) {
    // si la clase es occupied-slot
    const slot = event.target.closest('.occupied-slot');

    // Si no se encuentra, salir de la función
    if (!slot) return;

    const slotInfo = slot.querySelector('.slot-info');
    const estudiante = slotInfo.querySelector('.slot-estudiante').textContent;
    const profesor = slotInfo.querySelector('.slot-profesor').textContent;
    const salon = slotInfo.querySelector('.slot-salon').textContent;
    const horas = slotInfo.querySelector('.slot-horas').textContent;

    const slotData = {
      dia: slot.parentElement.parentElement.querySelector('.day-header').textContent,
      hora_inicio: horas.split(' - ')[0],
      hora_fin: horas.split(' - ')[1],
      estudiante: estudiante.split(': ')[1],
      profesor: profesor.split(': ')[1],
      salon: salon.split(': ')[1]
    };

    openModal(slotData);
  });


  // Referencias al modal y sus elementos
  const modal = document.getElementById('slot-modal');
  const closeModalButton = document.getElementById('close-modal');
  const modalBody = document.getElementById('modal-body');

  // Función para abrir el modal con los datos del slot
  function openModal(slot) {
    // Limpiar contenido anterior
    modalBody.innerHTML = '';

    // Crear elementos para mostrar la información
    const diaElem = document.createElement('p');
    diaElem.innerHTML = `<strong>Día:</strong> ${slot.dia}`;

    const horaInicioElem = document.createElement('p');
    horaInicioElem.innerHTML = `<strong>Hora Inicio:</strong> ${slot.hora_inicio}`;

    const horaFinElem = document.createElement('p');
    horaFinElem.innerHTML = `<strong>Hora Fin:</strong> ${slot.hora_fin}`;

    const estudianteElem = document.createElement('p');
    estudianteElem.innerHTML = `<strong>Estudiante:</strong> ${slot.estudiante}`;

    const profesorElem = document.createElement('p');
    profesorElem.innerHTML = `<strong>Profesor:</strong> ${slot.profesor}`;

    const salonElem = document.createElement('p');
    salonElem.innerHTML = `<strong>Salón:</strong> ${slot.salon}`;

    // Agregar los elementos al cuerpo del modal
    modalBody.appendChild(diaElem);
    modalBody.appendChild(horaInicioElem);
    modalBody.appendChild(horaFinElem);
    modalBody.appendChild(estudianteElem);
    modalBody.appendChild(profesorElem);
    modalBody.appendChild(salonElem);

    // Mostrar el modal
    modal.classList.remove('hidden');
  }

  // Función para cerrar el modal
  function closeModal() {
    modal.classList.add('hidden');
  }

  // Event listener para el botón de cerrar
  closeModalButton.addEventListener('click', closeModal);

  // Event listener para cerrar el modal al hacer clic fuera del contenido
  window.addEventListener('click', (event) => {
    if (event.target === modal) {
      closeModal();
    }
  });
</script>

<script type="module">
  // Referencia al botón
  const downloadButton = document.getElementById('download-schedule');

  // Evento click para el botón
  downloadButton.addEventListener('click', function() {
    // Elemento que deseas capturar
    const scheduleElement = document.querySelector('#screen-horario');

    // Opciones para html2canvas
    const options = {
      backgroundColor: null, // Si deseas que el fondo sea transparente
      useCORS: true // Habilita CORS para cargar imágenes externas si las hay
    };

    // Usar html2canvas para capturar el elemento
    html2canvas(scheduleElement, options).then(canvas => {
      // Convertir el canvas a una imagen en formato data URL
      const imgData = canvas.toDataURL('image/jpeg', 1.0);

      // Crear un enlace temporal para descargar la imagen
      const link = document.createElement('a');
      link.href = imgData;
      link.download = 'horario.jpg';

      // Simular un clic en el enlace para iniciar la descarga
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    }).catch(function(error) {
      console.error('Error al generar la imagen:', error);
    });
  });
</script>


<?= $this->endSection() ?>