<?= $this->extend('template\main') ?>

<?= $this->section('content') ?>
<!-- Modal toggle -->

<section class="flex flex-col gap-8 w-full">
  <h1 class="text-white text-6xl font-bold">Profesores</h1>
  <div class="flex justify-end">
    <button data-modal-target="default-modal" data-modal-toggle="default-modal" id="newProfessor" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
      Agregar nuevo profesores
    </button>
  </div>

  <div class="relative overflow-x-auto max-w-full text-white">
    <table id="tablaProfesores" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
        <?php foreach ($professors as $professor) : ?>
          <tr class="bg-white dark:bg-gray-800">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10">
                  <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=<?= $professor->Name ?>&background=random&color=fff" alt="">
                </div>
                <div class="ml-4">
                  <div class="text-sm font-medium text-gray-900 dark:text-white">
                    <?= $professor->Name ?>
                  </div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900 dark:text-white"><?= $professor->Email ?></div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <div class="flex gap-4">
                <button class="btn-edit-professor text-indigo-400 hover:text-indigo-600" data-professorid="<?= $professor->ProfessorID ?>">Editar</button>
                <button class="btn-delete-professor text-red-600 hover:text-red-900" data-professorid="<?= $professor->ProfessorID ?>">Eliminar</button>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <!-- Main modal -->
  <div id="modal-add" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 justify-center items-center w-full backdrop-blur m-0">
    <div id="contenedor-popup" class="relative w-full max-w-2xl h-screen p-4 lg:p-8">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 h-full flex flex-col">
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
        <section class="flex-1 overflow-y-auto p-4 md:p-8">
          <div class="mb-5">
            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
            <input type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
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
                <option selected>Agregue un salón</option>
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

            </section>
          </div>
        </section>
        <!-- Modal footer -->
        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
          <button id="btn-editar" data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Enviar</button>
          <button id="btn-cancelar" data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark: dark:hover:bg-gray-700">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const newProfessor = document.getElementById('newProfessor');
    const closeModal = document.getElementById('closeModal');
    const btnCancelar = document.getElementById('btn-cancelar');
    const modalAdd = document.getElementById('modal-add');
    const contenedorPopup = document.getElementById('contenedor-popup');

    // salones
    const selectSalones = document.getElementById('salones');

    // instrumentos
    const selectInstrumentos = document.getElementById('instrumentos');


    let table = new DataTable('#tablaProfesores', {
      responsive: true,
    });

    let formData = {
      professorId: '',
      modo: '',
      name: '',
      email: '',
      salones: [],
      instrumentos: [],
      agenda: [{
          diaName: 'Domingo',
          diaDisplay: 'Domingo',
          activo: false,
          horarios: []
        },
        {
          diaName: 'Lunes',
          diaDisplay: 'Lunes',
          activo: false,
          horarios: []
        },
        {
          diaName: 'Martes',
          diaDisplay: 'Martes',
          activo: false,
          horarios: []
        },
        {
          diaName: 'Miercoles',
          diaDisplay: 'Miércoles',
          activo: false,
          horarios: []
        },
        {
          diaName: 'Jueves',
          diaDisplay: 'Jueves',
          activo: false,
          horarios: []
        },
        {
          diaName: 'Viernes',
          diaDisplay: 'Viernes',
          activo: false,
          horarios: []
        },
        {
          diaName: 'Sabado',
          diaDisplay: 'Sábado',
          activo: false,
          horarios: []
        }
      ]
    };

    let copyFormData = JSON.parse(JSON.stringify(formData))

    const changeModalState = () => {
      modalAdd.classList.toggle('flex');
      modalAdd.classList.toggle('hidden');
    }

    <?php if ($modal) : ?>
      changeModalState();
    <?php endif; ?>

    newProfessor.addEventListener('click', () => {
      formData = JSON.parse(JSON.stringify(copyFormData))
      formData.modo = 'add';
      renderFormData();
      changeModalState();
    });

    closeModal.addEventListener('click', changeModalState);

    btnCancelar.addEventListener('click', changeModalState);

    function deleteAllSelectors() {
      const allSelectors = document.querySelectorAll('.select');
      allSelectors.forEach(selector => selector.remove());
    }

    const renderFormData = () => {
      renderNameAndEmail();
      renderSalones();
      renderInstrumentos();
      renderHorarios();
    }

    // nombre y email
    const $name = document.getElementById('name');
    const $email = document.getElementById('email');

    $name.addEventListener('input', function() {
      formData.name = $name.value;
    });

    $email.addEventListener('input', function() {
      formData.email = $email.value;
    });

    // render name y email
    const renderNameAndEmail = () => {
      $name.value = formData.name;
      $email.value = formData.email;
    }


    // select salones
    const renderSalones = () => {
      // renderizar salones
      const salonesAgregados = document.getElementById('salones-agregados');
      salonesAgregados.innerHTML = '';
      formData.salones.forEach(salon => {
        const div = document.createElement('div');
        div.classList.add('flex', 'items-center', 'gap-4', 'px-4', 'rounded-lg', 'py-1');
        div.innerHTML = `
        <span class="text-white" data-roomid="${salon.roomId}">${salon.roomName}</span>
        <button class="btn-delete text-red-500 font-medium rounded-lg text-sm p-1 text-center" data-roomid="${salon.roomId}">
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
        selectSalones.value = 'Agregue un salón';

        const btnDelete = div.querySelector('.btn-delete');
        btnDelete.addEventListener('click', function(e) {
          e.stopPropagation(); // Detiene la propagación del evento de clic
          formData.salones = formData.salones.filter(salon => salon.roomId !== btnDelete.dataset.roomid);
          renderSalones();
        });
      });
    }
    const salonesAgregados = document.getElementById('salones-agregados');
    selectSalones.addEventListener('change', function() {
      const option = selectSalones.options[selectSalones.selectedIndex];
      if (option.value === 'Agregue un salón') return;
      // validar si ya existe el salon
      const exists = formData.salones.some(salon => salon.roomId === option.value);
      if (exists) {
        selectSalones.value = 'Agregue un salón'
        return
      };

      formData.salones.push({
        roomId: option.value,
        roomName: option.text
      });

      renderSalones();
    });


    // select instrumentos
    const renderInstrumentos = () => {
      // renderizar instrumentos
      const instrumentosAgregados = document.getElementById('instrumentos-agregados');
      instrumentosAgregados.innerHTML = '';
      formData.instrumentos.forEach(instrumento => {
        const div = document.createElement('div');
        div.classList.add('flex', 'items-center', 'gap-4', 'px-4', 'rounded-lg', 'py-1');
        div.innerHTML = `
        <span class="text-white" data-instrumentid=${instrumento.instrumentId}>${instrumento.instrumentName}</span>
        <button class="btn-delete text-red-500 font-medium rounded-lg text-sm p-1 text-center" data-instrumentid=${instrumento.instrumentId}>
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
          formData.instrumentos = formData.instrumentos.filter(instrumento => instrumento.instrumentId !== btnDelete.dataset.instrumentid);
          renderInstrumentos();
        });
      });
    }
    const instrumentosAgregados = document.getElementById('instrumentos-agregados');
    selectInstrumentos.addEventListener('change', function() {
      const option = selectInstrumentos.options[selectInstrumentos.selectedIndex];
      if (option.value === 'Agregue un instrumento') return;
      // validar si ya existe el instrumento
      const exists = formData.instrumentos.some(instrumento => instrumento.instrumentId === option.value);
      if (exists) {
        selectInstrumentos.value = 'Agregue un instrumento'
        return;
      };

      formData.instrumentos.push({
        instrumentId: option.value,
        instrumentName: option.text
      });

      renderInstrumentos();
    });


    // horarios
    function renderHorarios() {
      const container = document.querySelector('.semana'); // Asegúrate de tener un contenedor en el HTML

      // Limpiamos el contenedor antes de renderizar
      container.innerHTML = '';

      // Recorremos la agenda del formData para generar cada día
      formData.agenda.forEach(dia => {
        const article = document.createElement('article');
        article.className = 'dia flex justify-between items-start';

        // Checkbox y etiqueta del día
        const checkboxDiv = document.createElement('div');
        checkboxDiv.className = 'checkbox flex gap-1 w-24 min-w-24 justify-start';

        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.className = 'w-5 p-1';
        checkbox.checked = dia.activo;
        checkbox.addEventListener('change', (e) => {
          dia.activo = e.target.checked;
          if (!dia.activo) {
            dia.horarios = [];
          }
          renderHorarios();
        });

        const span = document.createElement('span');
        span.className = 'text-sm';
        span.textContent = dia.diaDisplay;

        checkboxDiv.appendChild(checkbox);
        checkboxDiv.appendChild(span);

        // Div de horarios
        const horariosDiv = document.createElement('div');
        horariosDiv.className = 'horarios min-w-56 space-y-4';

        // Si el día está activo, renderizamos sus horarios
        if (dia.activo && dia.horarios.length > 0) {
          dia.horarios.forEach((horario, index) => {
            const horarioDiv = crearHorario(dia.diaName, index);
            horariosDiv.appendChild(horarioDiv);
          });
        } else {
          dia.horarios = [];
          dia.horarios.push({
            inicio: '',
            fin: ''
          });
          const horarioDiv = crearHorario(dia.diaName, 0);
          horariosDiv.appendChild(horarioDiv);
        }

        // Botón de añadir más horarios
        const accionesDiv = document.createElement('div');
        accionesDiv.className = 'acciones';

        const addButton = document.createElement('button');
        addButton.className = 'btn-add text-blue-400';
        addButton.innerHTML = `
            <svg height="24" viewBox="0 0 48 48" width="24" xmlns="http://www.w3.org/2000/svg">
              <path d="M0 0h48v48H0z" fill="none" />
              <path fill="currentColor" d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm10 22h-8v8h-4v-8h-8v-4h8v-8h4v8h8v4z" />
            </svg>
        `;

        // Acción de añadir horario
        addButton.addEventListener('click', function() {
          // si el ultimo horario esta vacio, que salte un error diciendo que debe llenar la hora de inicio y la de fin
          if (dia.horarios[dia.horarios.length - 1].inicio === '' || dia.horarios[dia.horarios.length - 1].fin === '') {
            Swal.fire({
              title: 'Error',
              text: 'Debe llenar la hora de inicio y la hora de fin del último horario',
              icon: 'error',
              showConfirmButton: true,
            });
            return;
          }

          const nuevoHorario = {
            inicio: '',
            fin: ''
          };
          dia.horarios.push(nuevoHorario);
          const horarioDiv = crearHorario(dia.diaName, dia.horarios.length - 1);
          horariosDiv.appendChild(horarioDiv);
          deleteAllSelectors();
        });

        accionesDiv.appendChild(addButton);

        // Añadimos todo al artículo
        article.appendChild(checkboxDiv);
        article.appendChild(horariosDiv);
        article.appendChild(accionesDiv);

        // Añadimos el artículo al contenedor
        container.appendChild(article);
      });
    }


    // Función para crear un bloque de horario
    function crearHorario(diaName, horarioIndex) {
      const horarioDiv = document.createElement('div');
      horarioDiv.className = 'horario flex items-center gap-2';

      const fechaInicioDiv = document.createElement('div');
      fechaInicioDiv.className = 'fecha-inicio-contenedor relative';

      const horaInicioInput = document.createElement('input');
      horaInicioInput.type = 'text';
      horaInicioInput.className = 'hora-inicio w-20 p-1 text-black';
      horaInicioInput.value = formData.agenda.find(d => d.diaName === diaName).horarios[horarioIndex].inicio;
      horaInicioInput.addEventListener('input', (e) => {
        formData.agenda.find(d => d.diaName === diaName).horarios[horarioIndex].inicio = e.target.value;
      });
      horaInicioInput.addEventListener('click', function() {
        deleteAllSelectors();
        crearSelectorHoras(fechaInicioDiv, diaName, horarioIndex, 'inicio');
      });

      fechaInicioDiv.appendChild(horaInicioInput);

      const separator = document.createElement('span');
      separator.textContent = '-';

      const fechaFinDiv = document.createElement('div');
      fechaFinDiv.className = 'fecha-fin-contenedor relative';

      const horaFinInput = document.createElement('input');
      horaFinInput.type = 'text';
      horaFinInput.className = 'hora-fin w-20 p-1 text-black';
      horaFinInput.value = formData.agenda.find(d => d.diaName === diaName).horarios[horarioIndex].fin;
      horaFinInput.addEventListener('input', (e) => {
        // si la hora de inicio esta vacia, no se puede seleccionar la hora de fin
        if (formData.agenda.find(d => d.diaName === diaName).horarios[horarioIndex].inicio === '') {
          Swal.fire({
            title: 'Error',
            text: 'Debe seleccionar una hora de inicio primero',
            icon: 'error',
            showConfirmButton: true,
          });
          horaFinInput.value = '';
          return;
        }
        formData.agenda.find(d => d.diaName === diaName).horarios[horarioIndex].fin = e.target.value;

      });
      horaFinInput.addEventListener('click', function() {
        deleteAllSelectors();
        crearSelectorHoras(fechaFinDiv, diaName, horarioIndex, 'fin');
      });

      fechaFinDiv.appendChild(horaFinInput);

      // Agregamos los inputs y el separador al div de horario
      horarioDiv.appendChild(fechaInicioDiv);
      horarioDiv.appendChild(separator);
      horarioDiv.appendChild(fechaFinDiv);

      if (horarioIndex >= 1) {
        const btnClose = document.createElement('button');
        btnClose.className = 'btn-close text-gray-300';
        btnClose.innerHTML = `
          <svg
            height="23"
            id="Layer_1"
            style="enable-background: new 0 0 512 512"
            version="1.1"
            viewBox="0 0 512 512"
            width="23"
            xml:space="preserve"
            xmlns="http:www.w3.org/2000/svg"
            xmlns:xlink="http:www.w3.org/1999/xlink"
          >
            <g>
              <path
                fill="currentColor"
                d="M256,33C132.3,33,32,133.3,32,257c0,123.7,100.3,224,224,224c123.7,0,224-100.3,224-224C480,133.3,379.7,33,256,33z    M364.3,332.5c1.5,1.5,2.3,3.5,2.3,5.6c0,2.1-0.8,4.2-2.3,5.6l-21.6,21.7c-1.6,1.6-3.6,2.3-5.6,2.3c-2,0-4.1-0.8-5.6-2.3L256,289.8   l-75.4,75.7c-1.5,1.6-3.6,2.3-5.6,2.3c-2,0-4.1-0.8-5.6-2.3l-21.6-21.7c-1.5-1.5-2.3-3.5-2.3-5.6c0-2.1,0.8-4.2,2.3-5.6l75.7-76   l-75.9-75c-3.1-3.1-3.1-8.2,0-11.3l21.6-21.7c1.5-1.5,3.5-2.3,5.6-2.3c2.1,0,4.1,0.8,5.6,2.3l75.7,74.7l75.7-74.7   c1.5-1.5,3.5-2.3,5.6-2.3c2.1,0,4.1,0.8,5.6,2.3l21.6,21.7c3.1,3.1,3.1,8.2,0,11.3l-75.9,75L364.3,332.5z"
              />
            </g>
          </svg>
        `;

        btnClose.addEventListener('click', function() {
          formData.agenda.find(d => d.diaName === diaName).horarios.splice(horarioIndex, 1);
          renderHorarios();
        });

        horarioDiv.appendChild(btnClose);
      }

      return horarioDiv;
    }


    function crearSelectorHoras(contenedor, dia, horarioIndex, tipo) {
      const agendaDia = formData.agenda.find(d => d.diaName === dia);
      if (agendaDia.horarios[horarioIndex].inicio === '' && tipo === 'fin') {
        Swal.fire({
          title: 'Error',
          text: 'Debe seleccionar una hora de inicio primero',
          icon: 'error',
          showConfirmButton: true,
        });
        return;
      }
      const horas = [
        "05:00", "05:30", "06:00", "06:30", "07:00", "07:30", "08:00", "08:30",
        "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30",
        "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30",
        "17:00", "17:30", "18:00", "18:30", "19:00", "19:30", "20:00", "20:30",
        "21:00", "21:30", "22:00"
      ];

      const divSelector = document.createElement('div');
      divSelector.className = 'select flex flex-col bg-slate-500 absolute overflow-y-scroll h-60 z-50 w-[110%] mb-10 shadow-md shadow-slate-800';

      let opcionesFiltradas = horas;

      // Filtrar horas según el tipo (inicio o fin)
      if (tipo === 'inicio') {
        if (agendaDia.horarios.length > 0) {
          // Obtener la última hora de fin del último horario registrado
          const indexUltimaHoraFin = horarioIndex === 0 ? 0 : horarioIndex - 1;
          const ultimaHoraFin = agendaDia.horarios[indexUltimaHoraFin].fin;
          // Filtrar las horas para que comiencen después de la última hora de fin
          opcionesFiltradas = ultimaHoraFin === '' ? horas : horas.filter(hora => hora > ultimaHoraFin);
        }
      } else if (tipo === 'fin') {

        // Filtrar las horas para que comiencen después de la hora de inicio
        opcionesFiltradas = horas.filter(hora => hora > agendaDia.horarios[horarioIndex].inicio);
      }

      // Crear los botones con las horas filtradas
      opcionesFiltradas.forEach(hora => {
        const button = document.createElement('button');
        button.className = 'hover:bg-slate-800 py-1';
        button.textContent = hora;

        button.addEventListener('click', function(e) {
          e.stopPropagation();
          formData.agenda.find(d => d.diaName === dia).activo = true;
          if (tipo === 'inicio') {
            formData.agenda.find(d => d.diaName === dia).horarios[horarioIndex].inicio = hora;
          } else {
            formData.agenda.find(d => d.diaName === dia).horarios[horarioIndex].fin = hora;
          }
          renderHorarios();
          divSelector.remove(); // Quita el selector después de elegir una hora
        });
        divSelector.appendChild(button);
      });

      contenedor.appendChild(divSelector);
    }


    // Llamamos a la función para renderizar los horarios inicialmente
    renderHorarios();


    const btnEnviar = document.getElementById('btn-editar');
    btnEnviar.addEventListener('click', () => {
      console.log(formData);
      // validar que todos los campos esten llenos
      let errores = [];
      if (formData.name === '') {
        errores.push('El campo nombre es obligatorio');
      }
      if (formData.email === '') {
        errores.push('El campo email es obligatorio');
      }
      if (formData.salones.length === 0) {
        errores.push('Debe agregar al menos un salón');
      }
      if (formData.instrumentos.length === 0) {
        errores.push('Debe agregar al menos un instrumento');
      }
      if (formData.agenda.every(dia => !dia.activo)) {
        errores.push('Debe seleccionar al menos un día de la semana');
      }

      if (formData.agenda.some(dia => dia.activo && dia.horarios.some(horario => horario.inicio === '' || horario.fin === ''))) {
        errores.push('Debe llenar la hora de inicio y la hora de fin de todos los horarios activos');
      }

      // si la hora de inicio es mayor a la hora de fin, que salte un error
      formData.agenda.forEach(dia => {
        if (dia.activo) {
          dia.horarios.forEach(horario => {
            if (horario.inicio !== '' && horario.fin !== '') {
              if (horario.inicio >= horario.fin) {
                errores.push(`La hora de inicio no puede ser mayor o igual a la hora de fin en ${dia.diaDisplay}`);
              }
            }
          });
        }
      });

      if (errores.length > 0) {
        Swal.fire({
          title: 'Error',
          html: errores.join('<br>'),
          icon: 'error',
          showConfirmButton: true,
        });
        return;
      }

      const urlApi = formData.modo === 'add' ? '<?= base_url('api/add-professor') ?>' : '<?= base_url('api/update-professor') ?>';

      fetch(urlApi, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(formData)
        }).then(response => response.json())
        .then(data => {
          let mensajeModo = formData.modo === 'add' ? 'agregado' : 'editado';
          let mensajeModoError = formData.modo === 'add' ? 'agregar' : 'editar';
          if (data.status === 'success') {
            Swal.fire({
              title: `Profesor ${mensajeModo}`,
              icon: 'success',
              showConfirmButton: false,
              timer: 1000
            }).then(() => {
              window.location.reload();
            });
          } else {
            console.log(data);
            Swal.fire({
              title: `Error al ${mensajeModoError} profesor`,
              text: data.message,
              icon: 'error',
              showConfirmButton: true,
            });
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });

    });

    const btnsDeleteProfessors = document.querySelectorAll('.btn-delete-professor');
    btnsDeleteProfessors.forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.stopPropagation();
        const professorId = btn.dataset.professorid;
        Swal.fire({
          title: '¿Estás seguro?',
          text: "¡No podrás revertir esto!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, borrarlo!'
        }).then((result) => {
          if (result.isConfirmed) {
            fetch('<?= base_url('api/delete-professor') ?>', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                  professorId
                })
              }).then(response => response.json())
              .then(data => {
                if (data.status === 'success') {
                  Swal.fire({
                    title: 'Profesor eliminado',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                  }).then(() => {
                    window.location.reload();
                  });
                } else {
                  console.log(data);
                  Swal.fire({
                    title: 'Error al eliminar profesor',
                    text: data.message,
                    icon: 'error',
                    showConfirmButton: true,
                  });
                }
              })
              .catch(error => {
                console.error('Error:', error);
              });
          }
        });
      });
    });

    const btnsEditProfessors = document.querySelectorAll('.btn-edit-professor');
    btnsEditProfessors.forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.stopPropagation();
        const professorId = btn.dataset.professorid;
        fetch('<?= base_url('api/get-professor') ?>', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              professorId
            })
          }).then(response => response.json())
          .then(data => {
            const {
              Name,
              Email
            } = data.professorData.professor;
            const {
              professorRooms,
              professorInstruments,
              professorAvailability
            } = data.professorData;

            formData.modo = 'edit';
            formData.professorId = professorId;
            formData.name = Name;
            formData.email = Email;

            formData.salones = professorRooms.map(room => {
              return {
                roomId: room.RoomID,
                roomName: room.RoomName
              };
            });

            formData.instrumentos = professorInstruments.map(instrument => {
              return {
                instrumentId: instrument.InstrumentID,
                instrumentName: instrument.InstrumentName
              };
            });

            professorAvailability.forEach(availability => {
              const dia = formData.agenda.find(d => d.diaName.toLowerCase() === availability.DayOfWeek.toLowerCase());

              if (dia) {
                dia.activo = true;

                const startTimeFormatted = availability.StartTime.split(':').slice(0, 2).join(':');
                const endTimeFormatted = availability.EndTime.split(':').slice(0, 2).join(':');

                // Eliminar horarios vacíos solo si es el primer horario agregado
                if (dia.horarios.length === 0 || (dia.horarios.length === 1 && dia.horarios[0].inicio === '' && dia.horarios[0].fin === '')) {
                  dia.horarios = [];
                }

                dia.horarios.push({
                  inicio: startTimeFormatted,
                  fin: endTimeFormatted
                });
              } else {
                console.warn('No se encontró el día');
              }
            });

            renderFormData();
            changeModalState();
          })
          .catch(error => {
            console.error('Error:', error);
          });
      });
    });

  });
</script>
<?= $this->endSection() ?>