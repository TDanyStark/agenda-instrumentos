<?= $this->extend('template\main') ?>

<?= $this->section('content') ?>

<section class="flex flex-col gap-8 w-full">
  <h1 class="text-white text-6xl font-bold">Horarios</h1>

  <?php if (empty($enrolls)) : ?>
    <div class="sinMatricula">
      <div class="flex items-center p-4 mb-4 text-sm rounded-lg  bg-gray-800 text-yellow-300" role="alert">
        <svg class="flex-shrink-0 inline w-6 h-6 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <p class="text-xl">
          <span class="font-semibold">Sin matriculas</span> si consideras que esto es un error, contacta con el administrador.
        </p>
      </div>
    </div>
  <?php else: ?>

    <div class="selectHorarios text-white grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-8">
      <?php foreach ($enrolls as $enroll) : ?>
        <div class="horario border border-blue-900 rounded flex flex-col justify-between">
          <div class="p-4 lg:p-6">
            <div class="flex justify-between items-start mb-4">
              <h3 class="text-3xl font-bold text-white"><?= $enroll->InstrumentName ?></h3>
              <span class="text-sm bg-primary rounded-full px-3 py-1">Semestre <?= $enroll->SemesterName ?></span>
            </div>
            <div class="space-y-3">
              <div class="flex items-center space-x-2">
                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" class="min-w-6 text-orange-400" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.05 2.53004L4.03002 6.46004C2.10002 7.72004 2.10002 10.54 4.03002 11.8L10.05 15.73C11.13 16.44 12.91 16.44 13.99 15.73L19.98 11.8C21.9 10.54 21.9 7.73004 19.98 6.47004L13.99 2.54004C12.91 1.82004 11.13 1.82004 10.05 2.53004Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M5.63 13.08L5.62 17.77C5.62 19.04 6.6 20.4 7.8 20.8L10.99 21.86C11.54 22.04 12.45 22.04 13.01 21.86L16.2 20.8C17.4 20.4 18.38 19.04 18.38 17.77V13.13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M21.4 15V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="text-xl"><?= $enroll->CourseName ?></span>
              </div>
              <?php if ($enroll->ScheduleID !== null): ?>
                <div class="flex items-center space-x-2">
                  <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" class="min-w-6 text-yellow-400" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 13H16C17.7107 13 19.1506 14.2804 19.3505 15.9795L20 21.5M8 13C5.2421 12.3871 3.06717 10.2687 2.38197 7.52787L2 6M8 13V18C8 19.8856 8 20.8284 8.58579 21.4142C9.17157 22 10.1144 22 12 22C13.8856 22 14.8284 22 15.4142 21.4142C16 20.8284 16 19.8856 16 18V17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                  </svg>
                  <span><?= $enroll->ProfessorName ? $enroll->ProfessorName : "❌" ?></span>
                </div>
                <div class="flex items-center space-x-2">
                  <svg width="24px" height="24px" viewBox="0 0 192 192" xmlns="http://www.w3.org/2000/svg" fill="none" class="min-w-6 text-violet-400">
                    <path stroke="currentColor" stroke-width="12" d="M96 22a51.88 51.88 0 0 0-36.77 15.303A52.368 52.368 0 0 0 44 74.246c0 16.596 4.296 28.669 20.811 48.898a163.733 163.733 0 0 1 20.053 28.38C90.852 163.721 90.146 172 96 172c5.854 0 5.148-8.279 11.136-20.476a163.723 163.723 0 0 1 20.053-28.38C143.704 102.915 148 90.841 148 74.246a52.37 52.37 0 0 0-15.23-36.943A51.88 51.88 0 0 0 96 22Z" />
                    <circle cx="96" cy="74" r="20" stroke="currentColor" stroke-width="12" />
                  </svg>
                  <span><?= $enroll->RoomName ? $enroll->RoomName : "❌" ?></span>
                </div>
                <div class="flex items-center space-x-2">
                  <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" class="min-w-6 text-lime-500" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 10H21M7 3V5M17 3V5M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <span><?= $enroll->DayOfWeek ? $enroll->DayOfWeek : "❌" ?></span>
                </div>
                <div class="flex items-center space-x-2">
                  <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" class="min-w-6 text-teal-500" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 7V12L14.5 10.5M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <span><?= $enroll->StartTime && $enroll->EndTime ? $enroll->StartTime . ' - ' . $enroll->EndTime : "❌" ?></span>
                </div>
              <?php endif ?>

            </div>
          </div>
          <?php if ($enroll->ScheduleID === null): ?>
            <div class="bg-gray-800 p-4 flex items-center justify-center">
              <button class="py-2 px-4 w-full text-center bg-primary text-white rounded text-xl btn-select-schedule" data-instrumentid="<?= $enroll->InstrumentID ?>" data-classduration="<?= $enroll->ClassDuration ?>" data-enrollid="<?= $enroll->EnrollID ?>">Seleccionar Horario</button>
            </div>
          <?php endif ?>
        </div>
      <?php endforeach ?>
    </div>

    <div class="horarios text-white">
    </div>

  <?php endif ?>
</section>

<style>
  /* Estilos para el popup */
  .schedule-popup {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1000;
  }

  .popup-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
  }

  .popup-content {
    position: relative;
    margin: 50px auto;
    padding: 20px;
    background: #1f2937;
    /* bg-gray-800 */
    border-radius: 8px;
    width: 90%;
    max-width: 500px;
    color: white;
    overflow-y: auto;
    max-height: 80vh;
  }

  .close-popup {
    position: absolute;
    top: 10px;
    right: 10px;
    background: transparent;
    border: none;
    font-size: 24px;
    color: white;
    cursor: pointer;
  }

  .day-button,
  .time-button {
    display: block;
    width: 100%;
    margin: 5px 0;
    padding: 10px;
    background: #3b82f6;
    /* bg-blue-500 */
    color: white;
    border: none;
    border-radius: 4px;
    text-align: left;
    cursor: pointer;
  }

  .day-button:hover,
  .time-button:hover {
    background: #2563eb;
    /* bg-blue-600 */
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', () => {

    let EnrollID = null;

    function showSchedulePopup(data) {
      // Crear el elemento del popup
      const popup = document.createElement('div');
      popup.classList.add('schedule-popup');
      popup.innerHTML = `
        <div class="popup-overlay"></div>
        <div class="popup-content">
            <h2>Seleccione un día</h2>
            <button class="close-popup">&times;</button>
            <div class="days-container"></div>
        </div>
        `;
      document.body.appendChild(popup);

      // Añadir eventos para cerrar el popup
      popup.querySelector('.close-popup').addEventListener('click', () => {
        popup.remove();
      });
      popup.querySelector('.popup-overlay').addEventListener('click', () => {
        popup.remove();
      });

      // Procesar los datos para obtener los días disponibles
      const daysSet = new Set();
      data.forEach(professor => {
        professor.AvailableSchedules.forEach(schedule => {
          daysSet.add(schedule.DayOfWeek);
        });
      });
      const days = Array.from(daysSet);

      // Mostrar los días disponibles
      const daysContainer = popup.querySelector('.days-container');
      days.forEach(day => {
        const dayButton = document.createElement('button');
        dayButton.classList.add('day-button');
        dayButton.textContent = day;
        dayButton.addEventListener('click', () => {
          // Cuando se hace clic en un día, mostrar las horas disponibles
          showTimeSlots(data, day, popup);
        });
        daysContainer.appendChild(dayButton);
      });
    }

    function showTimeSlots(data, selectedDay, popup) {
      // Limpiar el contenido actual y mostrar las horas
      const popupContent = popup.querySelector('.popup-content');
      popupContent.innerHTML = `
        <h2>Seleccione una hora para ${selectedDay}</h2>
        <button class="close-popup">&times;</button>
        <div class="times-container"></div>
      `;

      // Añadir eventos para cerrar el popup
      popupContent.querySelector('.close-popup').addEventListener('click', () => {
        popup.remove();
      });

      const timesContainer = popupContent.querySelector('.times-container');

      // Recorrer los profesores y sus horarios para el día seleccionado
      data.forEach(professor => {
        const professorSchedules = professor.AvailableSchedules.filter(schedule => schedule.DayOfWeek === selectedDay);

        if (professorSchedules.length > 0) {
          // Mostrar el nombre del profesor
          const professorTitle = document.createElement('h3');
          professorTitle.textContent = `Profesor: ${professor.ProfessorName}`;
          timesContainer.appendChild(professorTitle);

          // Mostrar las horas disponibles
          professorSchedules.forEach(schedule => {
            const timeButton = document.createElement('button');
            timeButton.classList.add('time-button');
            timeButton.textContent = `${schedule.StartTime} - ${schedule.EndTime} (Sala: ${schedule.RoomName})`;
            timeButton.addEventListener('click', () => {
              // Manejar la selección de la hora
              selectSchedule(professor.ProfessorID, schedule, popup);
            });
            timesContainer.appendChild(timeButton);
          });
        }
      });
    }

    function selectSchedule(professorID, schedule, popup) {

      if (EnrollID === null){
        alert("hubo un problema, contacte al administrador")
        return;
      }

      // Datos a enviar al backend
      const data = {
        ProfessorID: professorID,
        RoomID: schedule.RoomID,
        DayOfWeek: schedule.DayOfWeek,
        StartTime: schedule.StartTime,
        EndTime: schedule.EndTime,
        EnrollID: EnrollID
        // Agrega aquí otros datos necesarios, como EnrollID, StudentID, etc.
      };

      // Realizar la solicitud al backend para guardar el horario
      fetch('<?= base_url('api/schedule/saveSchedule') ?>', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
          if (result.status === 'success') {
            alert('Horario seleccionado correctamente.');
            // Actualizar la interfaz según sea necesario
            popup.remove();
            // Puedes recargar la página o actualizar el componente que muestra los horarios seleccionados
            location.reload();
          } else {
            alert('No se pudo seleccionar el horario.');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Ocurrió un error al seleccionar el horario.');
        });
    }



    $btnsSelectSchedules = document.querySelectorAll('.btn-select-schedule');
    $btnsSelectSchedules.forEach($btn => {
      $btn.addEventListener('click', async (e) => {

        EnrollID = e.target.dataset.enrollid;

        const $data = {
          InstrumentID: e.target.dataset.instrumentid,
          ClassDuration: e.target.dataset.classduration
        };
        console.log($data);

        const response = await fetch('<?= base_url('api/schedule/getAvailableSchedules') ?>', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify($data)
        });


        const result = await response.json();

        if (result.status === 'success') {
          // Llamar a la función para mostrar el popup
          showSchedulePopup(result.data);
        } else {
          // Manejar el error
          alert('No se pudieron obtener los horarios disponibles.');
        }
      });
    });
  });
</script>

<?= $this->endSection() ?>