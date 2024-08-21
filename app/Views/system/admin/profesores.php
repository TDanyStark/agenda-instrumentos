<?= $this->extend('template\main') ?>

<?= $this->section('content') ?>
<!-- Modal toggle -->

<section class="flex flex-col gap-8 w-full">
  <h1 class="text-white text-6xl font-bold">Profesores</h1>

  <div class="flex justify-end">
    <button data-modal-target="default-modal" data-modal-toggle="default-modal" id="openModal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
      Agregar nuevo profesores
    </button>
  </div>

  <div class="relative overflow-x-auto max-w-full">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-6 py-3">
            Nombre
          </th>
          <th scope="col" class="px-6 py-3">
            Email
          </th>
          <th scope="col" class="px-6 py-3">
            AC
          </th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <!-- Main modal -->
  <div id="modal-add" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50  justify-center items-center w-full max-h-full backdrop-blur m-0">
    <div id="contenedor-popup" class="relative p-4 w-full max-w-2xl max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
            Agregar profesor
          </h3>
          <button type="button" id="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:" data-modal-hide="default-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <section class="p-4 md:p-8">
          <div class="mb-5">
            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
            <input type="text" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
          </div>
          <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
          </div>
          <hr>
          <div class="flex py-6 px-2 gap-6">
            <div class="salones flex-1">
              <label for="salones" class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Salones</label>
              <select id="salones" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option selected>Agregue un salon</option>
                <?php foreach ($rooms as $room) : ?>
                  <option value="<?= $room->RoomID ?>"><?= $room->RoomName ?></option>
                <?php endforeach; ?>
              </select>
              <div id="salones-agregados" class="w-2/3"></div>
            </div>
            <div class="instrumentos flex-1">
              <label for="instrumentos" class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Instrumentos</label>
              <select id="instrumentos" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option selected>Agregue un instrumento</option>
                <?php foreach ($instruments as $instrument) : ?>
                  <option value="<?= $instrument->InstrumentID ?>"><?= $instrument->InstrumentName ?></option>
                <?php endforeach; ?>
              </select>
              <div id="instrumentos-agregados" class="w-2/3"></div>
            </div>
          </div>
          <hr>
          <div class="agenda py-6 px-2">
            <h3 class="text-white">Agenda disponible</h3>
            <section class="semana text-white py-4 space-y-6">


              <article class="dia flex justify-between items-start">

                <div class="checkbox flex gap-1 w-24 min-w-24 justify-start">
                  <input type="checkbox" class="w-5 p-1">
                  <span class="text-sm">Domingo</span>
                </div>

                <div class="horarios min-w-56 space-y-4">
                  <div class="horario flex items-center gap-2">
                    <div class="fecha-inicio-contenedor relative">
                      <input type="text" class="hora-inicio w-20 p-1 text-black">
                      <!-- insertar aqui -->
                    </div>
                    <span>-</span>
                    <div class="fecha-fin-contenedor relative">
                      <input type="text" class="hora-fin w-20 p-1 text-black">
                      <!-- insertar aqui -->

                    </div>
                  </div>

                </div>

                <div class="acciones flex">
                  <button class="btn-add text-blue-400">
                    <svg height="24" viewBox="0 0 48 48" width="24" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0 0h48v48H0z" fill="none" />
                      <path fill="currentColor" d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm10 22h-8v8h-4v-8h-8v-4h8v-8h4v8h8v4z" />
                    </svg>
                  </button>

                </div>

              </article>

              <article class="dia flex justify-between items-start">

                <div class="checkbox flex gap-1 w-24 min-w-24 justify-start">
                  <input type="checkbox" class="w-5 p-1">
                  <span class="text-sm">Lunes</span>
                </div>

                <div class="horarios min-w-56 space-y-4">
                  <div class="horario flex items-center gap-2">
                    <div class="fecha-inicio-contenedor relative">
                      <input type="text" class="hora-inicio w-20 p-1 text-black">
                      <!-- insertar aqui -->
                    </div>
                    <span>-</span>
                    <div class="fecha-fin-contenedor relative">
                      <input type="text" class="hora-fin w-20 p-1 text-black">
                      <!-- insertar aqui -->

                    </div>
                  </div>

                </div>

                <div class="acciones">
                  <button class="btn-add text-blue-400">
                    <svg height="24" viewBox="0 0 48 48" width="24" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0 0h48v48H0z" fill="none" />
                      <path fill="currentColor" d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm10 22h-8v8h-4v-8h-8v-4h8v-8h4v8h8v4z" />
                    </svg>
                  </button>

                </div>

              </article>

              <article class="dia flex justify-between items-start">

                <div class="checkbox flex gap-1 w-24 min-w-24 justify-start">
                  <input type="checkbox" class="w-5 p-1">
                  <span class="text-sm">Martes</span>
                </div>

                <div class="horarios min-w-56 space-y-4">
                  <div class="horario flex items-center gap-2">
                    <div class="fecha-inicio-contenedor relative">
                      <input type="text" class="hora-inicio w-20 p-1 text-black">
                      <!-- insertar aqui -->
                    </div>
                    <span>-</span>
                    <div class="fecha-fin-contenedor relative">
                      <input type="text" class="hora-fin w-20 p-1 text-black">
                      <!-- insertar aqui -->

                    </div>
                  </div>

                </div>

                <div class="acciones">
                  <button class="btn-add text-blue-400">
                    <svg height="24" viewBox="0 0 48 48" width="24" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0 0h48v48H0z" fill="none" />
                      <path fill="currentColor" d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm10 22h-8v8h-4v-8h-8v-4h8v-8h4v8h8v4z" />
                    </svg>
                  </button>

                </div>

              </article>

              <article class="dia flex justify-between items-start">

                <div class="checkbox flex gap-1 w-24 min-w-24 justify-start">
                  <input type="checkbox" class="w-5 p-1">
                  <span class="text-sm">Miercoles</span>
                </div>

                <div class="horarios min-w-56 space-y-4">
                  <div class="horario flex items-center gap-2">
                    <div class="fecha-inicio-contenedor relative">
                      <input type="text" class="hora-inicio w-20 p-1 text-black">
                      <!-- insertar aqui -->
                    </div>
                    <span>-</span>
                    <div class="fecha-fin-contenedor relative">
                      <input type="text" class="hora-fin w-20 p-1 text-black">
                      <!-- insertar aqui -->

                    </div>
                  </div>

                </div>

                <div class="acciones">
                  <button class="btn-add text-blue-400">
                    <svg height="24" viewBox="0 0 48 48" width="24" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0 0h48v48H0z" fill="none" />
                      <path fill="currentColor" d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm10 22h-8v8h-4v-8h-8v-4h8v-8h4v8h8v4z" />
                    </svg>
                  </button>

                </div>

              </article>

              <article class="dia flex justify-between items-start">

                <div class="checkbox flex gap-1 w-24 min-w-24 justify-start">
                  <input type="checkbox" class="w-5 p-1">
                  <span class="text-sm">Jueves</span>
                </div>

                <div class="horarios min-w-56 space-y-4">
                  <div class="horario flex items-center gap-2">
                    <div class="fecha-inicio-contenedor relative">
                      <input type="text" class="hora-inicio w-20 p-1 text-black">
                      <!-- insertar aqui -->
                    </div>
                    <span>-</span>
                    <div class="fecha-fin-contenedor relative">
                      <input type="text" class="hora-fin w-20 p-1 text-black">
                      <!-- insertar aqui -->

                    </div>
                  </div>

                </div>

                <div class="acciones">
                  <button class="btn-add text-blue-400">
                    <svg height="24" viewBox="0 0 48 48" width="24" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0 0h48v48H0z" fill="none" />
                      <path fill="currentColor" d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm10 22h-8v8h-4v-8h-8v-4h8v-8h4v8h8v4z" />
                    </svg>
                  </button>

                </div>

              </article>

              <article class="dia flex justify-between items-start">

                <div class="checkbox flex gap-1 w-24 min-w-24 justify-start">
                  <input type="checkbox" class="w-5 p-1">
                  <span class="text-sm">Viernes</span>
                </div>

                <div class="horarios min-w-56 space-y-4">
                  <div class="horario flex items-center gap-2">
                    <div class="fecha-inicio-contenedor relative">
                      <input type="text" class="hora-inicio w-20 p-1 text-black">
                      <!-- insertar aqui -->
                    </div>
                    <span>-</span>
                    <div class="fecha-fin-contenedor relative">
                      <input type="text" class="hora-fin w-20 p-1 text-black">
                      <!-- insertar aqui -->

                    </div>
                  </div>

                </div>

                <div class="acciones">
                  <button class="btn-add text-blue-400">
                    <svg height="24" viewBox="0 0 48 48" width="24" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0 0h48v48H0z" fill="none" />
                      <path fill="currentColor" d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm10 22h-8v8h-4v-8h-8v-4h8v-8h4v8h8v4z" />
                    </svg>
                  </button>

                </div>

              </article>

              <article class="dia flex justify-between items-start">

                <div class="checkbox flex gap-1 w-24 min-w-24 justify-start">
                  <input type="checkbox" class="w-5 p-1">
                  <span class="text-sm">Sabado</span>
                </div>

                <div class="horarios min-w-56 space-y-4">
                  <div class="horario flex items-center gap-2">
                    <div class="fecha-inicio-contenedor relative">
                      <input type="text" class="hora-inicio w-20 p-1 text-black">
                      <!-- insertar aqui -->
                    </div>
                    <span>-</span>
                    <div class="fecha-fin-contenedor relative">
                      <input type="text" class="hora-fin w-20 p-1 text-black">
                      <!-- insertar aqui -->

                    </div>
                  </div>

                </div>

                <div class="acciones">
                  <button class="btn-add text-blue-400">
                    <svg height="24" viewBox="0 0 48 48" width="24" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0 0h48v48H0z" fill="none" />
                      <path fill="currentColor" d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm10 22h-8v8h-4v-8h-8v-4h8v-8h4v8h8v4z" />
                    </svg>
                  </button>

                </div>

              </article>
            </section>
          </div>
        </section>
        <!-- Modal footer -->
        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
          <button id="btn-guardar" data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear</button>
          <button id="btn-cancelar" data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark: dark:hover:bg-gray-700">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const openModal = document.getElementById('openModal');
    const closeModal = document.getElementById('closeModal');
    const btnCancelar = document.getElementById('btn-cancelar');
    const modalAdd = document.getElementById('modal-add');
    const contenedorPopup = document.getElementById('contenedor-popup');

    const changeModalState = () => {
      modalAdd.classList.toggle('flex');
      modalAdd.classList.toggle('hidden');
    }

    <?php if ($modal) : ?>
      changeModalState();
    <?php endif; ?>

    openModal.addEventListener('click', changeModalState);

    closeModal.addEventListener('click', changeModalState);

    btnCancelar.addEventListener('click', changeModalState);

    modalAdd.addEventListener('click', function(e) {
      if (selectActive) {
        deleteAllSelectors();
      }
      if (!contenedorPopup.contains(e.target)) {
        changeModalState();
      }
    });


    // select salones
    const selectSalones = document.getElementById('salones');
    const salonesAgregados = document.getElementById('salones-agregados');
    selectSalones.addEventListener('change', function() {
      const option = selectSalones.options[selectSalones.selectedIndex];
      if (option.value === 'Agregue un salon') return;
      // validar si ya existe el salon
      const exists = Array.from(salonesAgregados.children).some(child => {
        return child.querySelector('span').textContent === option.text;
      });
      if (exists) return;

      const div = document.createElement('div');
      div.classList.add('flex', 'items-center', 'gap-4', 'px-4', 'rounded-lg', 'py-1');
      div.innerHTML = `
      <span class="text-white">${option.text}</span>
      <button class="btn-delete text-red-500 font-medium rounded-lg text-sm p-1 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30" width="24" height="24" class="icon">
        <style>
          .icon path,
          .icon line {
            stroke: currentColor;
            fill: currentColor;
          }
          .icon line {
            fill: none;
          }
        </style>
        <path d="M20.222,26H9.778c-1.014,0-1.868-0.759-1.986-1.766L6,9h18l-1.792,15.234C22.089,25.241,21.236,26,20.222,26z"/>
        <line x1="8.5" y1="5" x2="21.5" y2="5"/>
        <line x1="15" y1="3.5" x2="15" y2="5.5"/>
        <line x1="6" y1="6" x2="24" y2="6"/>
      </svg>
      </button>
    `;
      salonesAgregados.appendChild(div);
      selectSalones.value = 'Agregue un salon';


      const btnDelete = div.querySelector('.btn-delete');
      btnDelete.addEventListener('click', function(e) {
        e.stopPropagation(); // Detiene la propagación del evento de clic
        div.remove();
        selectSalones.value = 'Agregue un salon';
      });
    });

    // select instrumentos
    const selectInstrumentos = document.getElementById('instrumentos');
    const instrumentosAgregados = document.getElementById('instrumentos-agregados');
    selectInstrumentos.addEventListener('change', function() {
      const option = selectInstrumentos.options[selectInstrumentos.selectedIndex];
      if (option.value === 'Agregue un instrumento') return;
      // validar si ya existe el instrumento
      const exists = Array.from(instrumentosAgregados.children).some(child => {
        return child.querySelector('span').textContent === option.text;
      });
      if (exists) return;

      const div = document.createElement('div');
      div.classList.add('flex', 'items-center', 'gap-4', 'px-4', 'rounded-lg', 'py-1');
      div.innerHTML = `
      <span class="text-white">${option.text}</span>
      <button class="btn-delete text-red-500 font-medium rounded-lg text-sm p-1 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30" width="24" height="24" class="icon">
        <style>
          .icon path,
          .icon line {
            stroke: currentColor;
            fill: currentColor;
          }
          .icon line {
            fill: none;
          }
        </style>
        <path d="M20.222,26H9.778c-1.014,0-1.868-0.759-1.986-1.766L6,9h18l-1.792,15.234C22.089,25.241,21.236,26,20.222,26z"/>
        <line x1="8.5" y1="5" x2="21.5" y2="5"/>
        <line x1="15" y1="3.5" x2="15" y2="5.5"/>
        <line x1="6" y1="6" x2="24" y2="6"/>
      </svg>
      </button>
    `;
      instrumentosAgregados.appendChild(div);
      selectInstrumentos.value = 'Agregue un instrumento';


      const btnDelete = div.querySelector('.btn-delete');
      btnDelete.addEventListener('click', function(e) {
        e.stopPropagation(); // Detiene la propagación del evento de clic
        div.remove();
        selectInstrumentos.value = 'Agregue un instrumento';
      });
    });


    let horasInicioInput = document.querySelectorAll('.hora-inicio');
    let horasFinInput = document.querySelectorAll('.hora-fin');
    let btnsAdd = document.querySelectorAll('.btn-add');
    let btnsClose = document.querySelectorAll('.btn-close');

    let selectActive = null;

    function crearSelectorDeHoras(container) {
      // Elimina cualquier selector existente
      const existingSelector = container.querySelector('.select');
      if (existingSelector) {
        existingSelector.remove();
      }

      selectActive = true;

      const horas = [
        "05:00", "05:30", "06:00", "06:30", "07:00", "07:30", "08:00", "08:30",
        "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30",
        "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30",
        "17:00", "17:30", "18:00", "18:30", "19:00", "19:30", "20:00", "20:30",
        "21:00", "21:30", "22:00"
      ];

      const divSelector = document.createElement('div');
      divSelector.className = 'select flex flex-col bg-slate-500 absolute overflow-y-scroll max-h-28 z-50 w-[110%] shadow-md shadow-slate-800';

      horas.forEach(hora => {
        const button = document.createElement('button');
        button.className = 'hover:bg-slate-800 py-1';
        button.textContent = hora;

        // si el input es de hora de fin, no permitir seleccionar horas anteriores a la hora de inicio
        if (container.querySelector('.hora-fin')) {
          const containerPadre = container.parentElement;
          const horaInicio = containerPadre.querySelector('.hora-inicio').value;
          if (horaInicio) {
            const horaInicioIndex = horas.indexOf(horaInicio);
            const horaIndex = horas.indexOf(hora);
            if (horaIndex <= horaInicioIndex) {
              button.disabled = true;
              button.classList.add('hidden');
            }
          }
        }

        let horarios = container.parentElement.parentElement.querySelectorAll('.horario');
        if (horarios.length > 1) {
          horarios.forEach(horario => {
            const horaInicio = horario.querySelector('.hora-inicio').value;
            const horaFin = horario.querySelector('.hora-fin').value;
            if (horaInicio && horaFin) {
              // deshabilitar todas las horas que estén dentro desde el primer horario hasta el último
              const horaInicioIndex = horas.indexOf(horaInicio);
              const horaFinIndex = horas.indexOf(horaFin);
              const horaIndex = horas.indexOf(hora);
              if (horaIndex < horaFinIndex) {
                button.disabled = true;
                button.classList.add('hidden');
              }
            }
          });
        }


        button.addEventListener('click', function(e) {
          e.stopPropagation();
          container.querySelector('input').value = hora;
          divSelector.remove(); // Quita el selector después de elegir una hora
          selectActive = false;
        });
        divSelector.appendChild(button);
      });

      container.appendChild(divSelector);
    }

    function deleteAllSelectors() {
      const allSelectors = document.querySelectorAll('.select');
      allSelectors.forEach(selector => selector.remove());
    }

    function addNewShedule(contenedor) {
      const shelude = document.createElement('div');
      shelude.className = 'horario flex items-center gap-2';
      shelude.innerHTML = `
                <div class="fecha-inicio-contenedor relative">
                    <input type="text" class="hora-inicio w-20 p-1 text-black">
                </div>
                <span>-</span>
                <div class="fecha-fin-contenedor relative">
                    <input type="text" class="hora-fin w-20 p-1 text-black">
                </div>
                <button class="btn-close text-gray-300">
                      <svg height="23" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="23" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g>
                          <path fill="currentColor" d="M256,33C132.3,33,32,133.3,32,257c0,123.7,100.3,224,224,224c123.7,0,224-100.3,224-224C480,133.3,379.7,33,256,33z    M364.3,332.5c1.5,1.5,2.3,3.5,2.3,5.6c0,2.1-0.8,4.2-2.3,5.6l-21.6,21.7c-1.6,1.6-3.6,2.3-5.6,2.3c-2,0-4.1-0.8-5.6-2.3L256,289.8   l-75.4,75.7c-1.5,1.6-3.6,2.3-5.6,2.3c-2,0-4.1-0.8-5.6-2.3l-21.6-21.7c-1.5-1.5-2.3-3.5-2.3-5.6c0-2.1,0.8-4.2,2.3-5.6l75.7-76   l-75.9-75c-3.1-3.1-3.1-8.2,0-11.3l21.6-21.7c1.5-1.5,3.5-2.3,5.6-2.3c2.1,0,4.1,0.8,5.6,2.3l75.7,74.7l75.7-74.7   c1.5-1.5,3.5-2.3,5.6-2.3c2.1,0,4.1,0.8,5.6,2.3l21.6,21.7c3.1,3.1,3.1,8.2,0,11.3l-75.9,75L364.3,332.5z" />
                        </g>
                      </svg>
                    </button>
            `;
      contenedor.appendChild(shelude);
      btnsClose = document.querySelectorAll('.btn-close');
      shelude.addEventListener('click', function(e) {
        e.stopPropagation();
        if (e.target.closest('.btn-close')) {
          const schedule = e.target.closest('.horario');
          if (schedule) {
            schedule.remove();
          }
        }
      });
      handlerClickInputs();
    }

    function handlerClickInputs() {
      horasInicioInput = document.querySelectorAll('.hora-inicio');
      horasFinInput = document.querySelectorAll('.hora-fin');
      horasInicioInput.forEach(horaInicioInput => {
        horaInicioInput.addEventListener('click', function(e) {
          e.stopPropagation();
          deleteAllSelectors();
          crearSelectorDeHoras(horaInicioInput.parentElement);
        });
      });

      horasFinInput.forEach(horaFinInput => {
        horaFinInput.addEventListener('click', function(e) {
          e.stopPropagation();
          deleteAllSelectors();
          crearSelectorDeHoras(horaFinInput.parentElement);
        });
      });
    }

    btnsAdd.forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.stopPropagation();
        let contendor = btn.parentElement.parentElement.querySelector('.horarios');
        addNewShedule(contendor);
      });
    });

    handlerClickInputs();

    const btnGuardar = document.getElementById('btn-guardar');

    btnGuardar.addEventListener('click', () => {
      // ver el nombre, email, salones, instrumentos y horarios
      // errores de validación
      const errors = [];


      const nombre = document.getElementById('nombre').value;
      const email = document.getElementById('email').value;
      const salones = Array.from(salonesAgregados.children).map(child => child.querySelector('span').textContent);
      if (salones.length === 0) {
        errors.push('Debe agregar al menos un salón');
      }

      const instrumentos = Array.from(instrumentosAgregados.children).map(child => child.querySelector('span').textContent);
      if (instrumentos.length === 0) {
        errors.push('Debe agregar al menos un instrumento');
      }

      let almenosUnDia = false;

      let dias = Array.from(document.querySelectorAll('.dia')).map(dia => {
        const checkbox = dia.querySelector('input[type="checkbox"]');
        // si el checkbox no está activo, no se toma en cuenta
        if (!checkbox.checked) {
          return {
            diaSemana: dia.querySelector('span').textContent,
            horarios: [],
            activo: false
          };
        }

        const diaSemana = dia.querySelector('span').textContent;
        const horarios = Array.from(dia.querySelectorAll('.horario')).map(horario => {

          const horaInicio = horario.querySelector('.hora-inicio').value;
          const horaFin = horario.querySelector('.hora-fin').value;
          return {
            horaInicio,
            horaFin
          };
        });
        return {
          diaSemana,
          horarios,
          activo: checkbox.checked
        };
      });

      dias.forEach(dia => {
        if (dia.activo) {
          almenosUnDia = true;
          dia.horarios.forEach(horario => {
            if (horario.horaInicio === '' || horario.horaFin === '') {
              errors.push(`Debe seleccionar una hora de inicio y una hora de fin para el día ${dia.diaSemana}`);
              return;
            }
            if (horario.horaInicio >= horario.horaFin) {
              errors.push(`La hora de inicio debe ser menor a la hora de fin para el día ${dia.diaSemana}`);
            }

          });
        }
      });

      dias = dias.filter(dia => dia.activo);

      if (!almenosUnDia) {
        errors.push('Debe seleccionar al menos un día');
      }

      if (errors.length > 0) {
        alert(errors.join('\n'));
        return;
      }

      console.log({
        nombre,
        email,
        salones,
        instrumentos,
        dias
      });
    });

    const btnsDelete = document.querySelectorAll('.btn-delete');

    btnsDelete.forEach(btn => {
      btn.addEventListener('click', function() {

      });
    });


  });
</script>
<?= $this->endSection() ?>