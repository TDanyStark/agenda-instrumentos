<?= $this->extend('template\main') ?>

<?= $this->section('content') ?>
<!-- Modal toggle -->

<section class="flex flex-col gap-8 w-full">
  <h1 class="text-white text-6xl font-bold">Matrículas</h1>
  <div class="flex justify-end">
    <button id="newEnrollment" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
      Agregar nueva matrícula
    </button>
  </div>

  <div class="relative overflow-x-auto max-w-full text-white">
    <table id="tablaMatriculas" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-6 py-3">
            Estudiante
          </th>
          <th scope="col" class="px-6 py-3">
            Curso
          </th>
          <th scope="col" class="px-6 py-3">
            Instrumento
          </th>
          <th scope="col" class="px-6 py-3">
            Semestre
          </th>
          <th scope="col" class="px-6 py-3">
            ¿Con horario?
          </th>
          <th scope="col" class="px-6 py-3">
            Acciones
          </th>
        </tr>
      </thead>
      <tbody class="text-white">
        <?php foreach ($enrollments as $enrollment) : ?>
          <tr>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10">
                  <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=<?= $enrollment->StudentName ?>&background=random&color=fff" alt="">
                </div>
                <div class="ml-4">
                  <div class="text-sm font-medium ">
                    <?= $enrollment->StudentName ?>
                  </div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <?= $enrollment->CourseName ?>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <?= $enrollment->InstrumentName ?>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              <?= $enrollment->SemesterName ?>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              <?= $enrollment->ScheduleID !== null ? "✅" : "❌" ?>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <div class="flex gap-4">
                <button class="btn-edit-enrollment text-indigo-400 hover:text-indigo-600" data-enrollmentid="<?= $enrollment->EnrollID ?>">Editar</button>
                <button class="btn-delete-enrollment text-red-600 hover:text-red-900" data-enrollmentid="<?= $enrollment->EnrollID ?>">Eliminar</button>
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
            Agregar Matrícula
          </h3>
          <button type="button" id="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="default-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7L1 13" />
            </svg>
            <span class="sr-only">Cerrar modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <section class="flex-1 overflow-y-auto p-4 md:p-8">
          <div class="mb-5 relative">
            <label for="studentSearch" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estudiante</label>
            <input type="text" id="studentSearch" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" autocomplete="off">
            <input type="hidden" id="studentId">
            <div id="studentResults" class="absolute z-10 bg-white w-full shadow-lg hidden"></div>
          </div>
          <div class="mb-5">
            <label for="courseSelect" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Curso</label>
            <select id="courseSelect" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
              <option value="">Seleccione un curso</option>
              <?php foreach ($courses as $course): ?>
                <option value="<?= $course->CourseID  ?>"><?= $course->CourseName ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-5">
            <label for="instrumentSelect" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Instrumento</label>
            <select id="instrumentSelect" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
              <option value="">Seleccione un instrumento</option>
              <?php foreach ($instruments as $instrument): ?>
                <option value="<?= $instrument->InstrumentID ?>"><?= $instrument->InstrumentName ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-5">
            <label for="semesterSelect" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Semestre</label>
            <select id="semesterSelect" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
              <option value="">Seleccione un semestre</option>
              <?php foreach ($semesters as $semester): ?>
                <option value="<?= $semester->SemesterID  ?>"><?= $semester->SemesterName   ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-5">
            <!-- input checkbox -->
            <input type="checkbox" id="status" class="form-checkbox h-5 w-5 text-blue-600">
            <label for="status" class="inline-block ml-2 text-sm text-gray-900 dark:text-white">Activo</label>
          </div>
        </section>
        <!-- Modal footer -->
        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
          <button id="btn-submit" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Guardar</button>
          <button id="btn-cancel" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const newEnrollment = document.getElementById('newEnrollment');
    const closeModal = document.getElementById('closeModal');
    const btnCancel = document.getElementById('btn-cancel');
    const modalAdd = document.getElementById('modal-add');
    const btnSubmit = document.getElementById('btn-submit');

    const studentSearch = document.getElementById('studentSearch');
    const studentResults = document.getElementById('studentResults');
    const studentIdInput = document.getElementById('studentId');

    const courseSelect = document.getElementById('courseSelect');
    const instrumentSelect = document.getElementById('instrumentSelect');
    const semesterSelect = document.getElementById('semesterSelect');

    const statusCheckbox = document.getElementById('status');

    let table = new DataTable('#tablaMatriculas', {
      responsive: true,
      order: []
    });

    let formData = {
      enrollId: '',
      mode: '',
      studentId: '',
      courseId: '',
      instrumentId: '',
      semesterId: '',
      status: 1
    };

    const changeModalState = () => {
      modalAdd.classList.toggle('flex');
      modalAdd.classList.toggle('hidden');
    };

    newEnrollment.addEventListener('click', () => {
      clearFormData();
      formData.mode = 'add';
      renderFormData();
      changeModalState();
    });

    closeModal.addEventListener('click', changeModalState);
    btnCancel.addEventListener('click', changeModalState);

    // Search functionality for students
    studentSearch.addEventListener('input', function() {
      const query = studentSearch.value;
      if (query.length >= 3) {
        searchEntities('students', query, studentResults, 'student');
      } else {
        studentResults.innerHTML = '';
        studentResults.classList.add('hidden');
      }
    });

    // Course selection
    courseSelect.addEventListener('change', function() {
      formData.courseId = courseSelect.value;
    });

    // Instrument and Semester selection
    instrumentSelect.addEventListener('change', function() {
      formData.instrumentId = instrumentSelect.value;
    });

    semesterSelect.addEventListener('change', function() {
      formData.semesterId = semesterSelect.value;
    });

    statusCheckbox.addEventListener('change', function() {
      formData.status = statusCheckbox.checked ? 1 : 0;
    });

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

    // Function to display search results
    function displayResults(data, resultsContainer, inputType) {
      resultsContainer.innerHTML = '';
      if (data.length > 0) {
        data.forEach(item => {
          const div = document.createElement('div');
          div.className = 'result-item p-2 hover:bg-gray-200 cursor-pointer';
          div.textContent = item.name;
          div.dataset.id = item.id;
          div.addEventListener('click', function() {
            if (inputType === 'student') {
              studentSearch.value = item.name;
              studentIdInput.value = item.id;
              studentResults.innerHTML = '';
              studentResults.classList.add('hidden');
              formData.studentId = item.id;
            }
          });
          resultsContainer.appendChild(div);
        });
        resultsContainer.classList.remove('hidden');
      } else {
        resultsContainer.classList.add('hidden');
      }
    }

    function clearFormData() {
      formData = {
        enrollId: '',
        mode: '',
        studentId: '',
        courseId: '',
        instrumentId: '',
        semesterId: '',
        status: 1
      };
    }

    function renderFormData() {
      // Populate fields with existing data
      studentSearch.value = formData.studentName || '';
      studentIdInput.value = formData.studentId;
      courseSelect.value = formData.courseId;
      instrumentSelect.value = formData.instrumentId;
      semesterSelect.value = formData.semesterId;
      statusCheckbox.checked = formData.status === 1;
    }

    btnSubmit.addEventListener('click', async () => {
      // Validate form data
      const errors = [];
      if (!formData.studentId) {
        errors.push('Debe seleccionar un estudiante.');
      }
      if (!formData.courseId) {
        errors.push('Debe seleccionar un curso.');
      }
      if (!formData.instrumentId) {
        errors.push('Debe seleccionar un instrumento.');
      }
      if (!formData.semesterId) {
        errors.push('Debe seleccionar un semestre.');
      }

      if (errors.length > 0) {
        Swal.fire({
          title: 'Error',
          html: errors.join('<br>'),
          icon: 'error',
          showConfirmButton: true,
        });
        return;
      }

      // pasar los ID a enteros
      formData.enrollId = parseInt(formData.enrollId || 0);
      formData.studentId = parseInt(formData.studentId);
      formData.courseId = parseInt(formData.courseId);
      formData.instrumentId = parseInt(formData.instrumentId);
      formData.semesterId = parseInt(formData.semesterId);

      console.log(formData);

      const urlApi = formData.mode === 'add' ?
        '<?= base_url('api/add-enroll') ?>' :
        '<?= base_url('api/update-enroll') ?>';

      try {
        const response = await fetch(urlApi, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(formData)
        });

        if (!response.ok) {
          const errorData = await response.json();
          throw new Error(errorData.message || 'Error al guardar la matrícula');
        }

        const result = await response.json();

        if (result.status !== 'success') {
          throw new Error(result.message || 'Error desconocido al guardar matrícula');
        }

        const message = formData.mode === 'add' ? 'Matrícula agregada' : 'Matrícula actualizada';

        Swal.fire({
          title: message,
          icon: 'success',
          showConfirmButton: false,
          timer: 1000
        }).then(() => {
          window.location.reload();
        });

      } catch (error) {
        console.error('Error:', error);

        const action = formData.mode === 'add' ? 'agregar' : 'actualizar';

        Swal.fire({
          title: `Error al ${action} matrícula`,
          text: error.message,
          icon: 'error',
          showConfirmButton: true,
        });
      }
    });

    // Edit and delete buttons functionality
    const btnsDeleteEnrollment = document.querySelectorAll('.btn-delete-enrollment');
    btnsDeleteEnrollment.forEach(btn => {
      btn.addEventListener('click', async function(e) {
        e.stopPropagation();
        const enrollId = btn.dataset.enrollmentid;

        const result = await Swal.fire({
          title: '¿Estás seguro?',
          text: "¡No podrás revertir esto!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Sí, borrarlo!'
        });

        if (result.isConfirmed) {
          try {
            const response = await fetch('<?= base_url('api/delete-enroll') ?>', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                enrollId
              })
            });

            if (!response.ok) {
              const errorData = await response.json();
              throw new Error(errorData.message || 'Error al eliminar la matrícula');
            }

            const result = await response.json();

            if (result.status !== 'success') {
              throw new Error(result.message || 'Error desconocido al eliminar matrícula');
            }

            Swal.fire({
              title: 'Matrícula eliminada',
              icon: 'success',
              showConfirmButton: false,
              timer: 1500
            }).then(() => {
              window.location.reload();
            });

          } catch (error) {
            console.error('Error:', error);

            Swal.fire({
              title: 'Error',
              text: error.message,
              icon: 'error',
              showConfirmButton: true,
            });
          }
        }
      });
    });

    const btnsEditEnrollment = document.querySelectorAll('.btn-edit-enrollment');
    btnsEditEnrollment.forEach(btn => {
      btn.addEventListener('click', async function(e) {
        e.stopPropagation();
        clearFormData();
        const enrollId = btn.dataset.enrollmentid;

        try {
          const response = await fetch('<?= base_url('api/get-enroll') ?>', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              enrollId
            })
          });

          if (!response.ok) {
            const errorData = await response.json();
            throw new Error(errorData.message || 'Error al obtener datos de la matrícula');
          }

          const result = await response.json();

          if (result.status === 'error') {
            throw new Error(result.message || 'Error desconocido al obtener datos de la matrícula');
          }

          const [data] = result.data;

          formData.mode = 'edit';
          formData.enrollId = parseInt(data.EnrollID);
          formData.studentId = parseInt(data.StudentID);
          formData.courseId = parseInt(data.CourseID);
          formData.instrumentId = parseInt(data.InstrumentID);
          formData.semesterId = parseInt(data.SemesterID);
          formData.status = parseInt(data.Status);
          formData.studentName = data.StudentName;

          renderFormData();
          changeModalState();

        } catch (error) {
          console.error('Error:', error);
          Swal.fire({
            title: 'Error',
            text: 'Ocurrió un error al obtener los datos de la matrícula',
            icon: 'error',
            showConfirmButton: true,
          });
        }
      });
    });

  });
</script>
<?= $this->endSection() ?>