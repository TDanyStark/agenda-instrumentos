<?= $this->extend('template\main') ?>

<?= $this->section('content') ?>
<!-- Modal toggle -->

<section class="flex flex-col gap-8 w-full">
  <h1 class="text-white text-6xl font-bold">Estudiantes</h1>
  <div class="flex justify-end">
    <button data-modal-target="default-modal" data-modal-toggle="default-modal" id="newStudent" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
      Agregar nuevo estudiante
    </button>
  </div>

  <div class="relative overflow-x-auto max-w-full text-white">
    <table id="tablaEstudiantes" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-6 py-3">
            estado
          </th>
          <th scope="col" class="px-6 py-3">
            Nombre
          </th>
          <th scope="col" class="px-6 py-3">
            Apellido
          </th>
          <th scope="col" class="px-6 py-3">
            Cédula
          </th>
          <th scope="col" class="px-6 py-3">
            Celular
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
        <?php foreach ($students as $student) : ?>
          <tr class="bg-white dark:bg-gray-800">
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $student->Status == 1 ? 'bg-green-100' : 'bg-red-100' ?> <?= $student->Status == 1 ? 'text-green-800' : 'text-red-800' ?>">
                <?= $student->Status == 1 ? 'Activo' : 'Inactivo' ?>
              </span>
            </td>

            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10">
                  <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=<?= $student->FirstName ?>&background=random&color=fff" alt="">
                </div>
                <div class="ml-4">
                  <div class="text-sm font-medium text-gray-900 dark:text-white">
                    <?= $student->FirstName ?>
                  </div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900 dark:text-white"><?= $student->LastName ?></div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900 dark:text-white"><?= $student->Cedula ?></div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900 dark:text-white"><?= $student->Phone ?></div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900 dark:text-white"><?= $student->Email ?></div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <div class="flex gap-4">
                <button class="btn-edit-student text-indigo-400 hover:text-indigo-600" data-studentid="<?= $student->StudentID ?>">Editar</button>
                <button class="btn-delete-student text-red-600 hover:text-red-900" data-studentid="<?= $student->StudentID ?>">Eliminar</button>
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
            Agregar estudiante
          </h3>
          <button type="button" id="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="default-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <section class="flex-1 overflow-y-auto p-4 md:p-8">
          <div class="mb-5">
            <label for="firstName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
            <input type="text" id="firstName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
          </div>
          <div class="mb-5">
            <label for="lastName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido</label>
            <input type="text" id="lastName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
          </div>
          <div class="mb-5">
            <label for="cedula" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cédula</label>
            <input type="text" id="cedula" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
          </div>
          <div class="mb-5">
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Celular</label>
            <input type="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
          </div>
          <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
          </div>
          <div class="mb-5">
            <!-- input checkbox -->
            <input type="checkbox" id="status" class="form-checkbox h-5 w-5 text-blue-600">
            <label for="status" class="inline-block ml-2 text-sm text-gray-900 dark:text-white">Activo</label>
          </div>
        </section>
        <!-- Modal footer -->
        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
          <button id="btn-editar" data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Enviar</button>
          <button id="btn-cancelar" data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark: dark:hover:bg-gray-700">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const newStudent = document.getElementById('newStudent');
    const closeModal = document.getElementById('closeModal');
    const btnCancelar = document.getElementById('btn-cancelar');
    const modalAdd = document.getElementById('modal-add');

    let table = new DataTable('#tablaEstudiantes', {
      responsive: true,
      order: []
    });

    let formData = {
      StudentID: '',
      modo: '',
      firstName: '',
      lastName: '',
      cedula: '',
      email: '',
      phone: '',
      status: 1
    };

    let copyFormData = JSON.parse(JSON.stringify(formData))

    const changeModalState = () => {
      modalAdd.classList.toggle('flex');
      modalAdd.classList.toggle('hidden');
    }

    newStudent.addEventListener('click', () => {
      cleanFormData();
      formData.modo = 'add';
      renderFormData();
      changeModalState();
    });

    closeModal.addEventListener('click', changeModalState);

    btnCancelar.addEventListener('click', changeModalState);

    const renderFormData = () => {
      renderFields();
    }

    function cleanFormData() {
      formData = JSON.parse(JSON.stringify(copyFormData));
      // renderFormData();
    }

    // Campos del formulario
    const $firstName = document.getElementById('firstName');
    const $lastName = document.getElementById('lastName');
    const $cedula = document.getElementById('cedula');
    const $email = document.getElementById('email');
    const $phone = document.getElementById('phone');
    const $status = document.getElementById('status');

    $firstName.addEventListener('input', function() {
      formData.firstName = $firstName.value;
    });

    $lastName.addEventListener('input', function() {
      formData.lastName = $lastName.value;
    });

    $cedula.addEventListener('input', function() {
      formData.cedula = $cedula.value;
    });

    $email.addEventListener('input', function() {
      formData.email = $email.value;
    });

    $phone.addEventListener('input', function() {
      formData.phone = $phone.value;
    });

    $status.addEventListener('change', function() {
      formData.status = $status.checked ? 1 : 0;
    });

    const renderFields = () => {
      $firstName.value = formData.firstName;
      $lastName.value = formData.lastName;
      $cedula.value = formData.cedula;
      $email.value = formData.email;
      $phone.value = formData.phone;
      $status.checked = formData.status === 1;
    }

    const btnEnviar = document.getElementById('btn-editar');
    btnEnviar.addEventListener('click', async () => {
      try {
        console.log(formData);

        // Validar que todos los campos obligatorios estén llenos
        let errores = [];
        if (formData.firstName === '') {
          errores.push('El campo Nombre es obligatorio');
        }
        if (formData.lastName === '') {
          errores.push('El campo Apellido es obligatorio');
        }
        if (formData.cedula === '') {
          errores.push('El campo Cédula es obligatorio');
        }
        if (formData.email === '') {
          errores.push('El campo Email es obligatorio');
        }

        // Si hay errores, lanzamos una excepción para manejarlos en el catch
        if (errores.length > 0) {
          throw new Error(errores.join('<br>'));
        }

        const urlApi = formData.modo === 'add' ? '<?= base_url('api/add-student') ?>' : '<?= base_url('api/update-student') ?>';

        const response = await fetch(urlApi, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(formData)
        });

        // Verificar si la respuesta es correcta
        if (!response.ok) {
          const errorData = await response.json();
          throw new Error(errorData.message || 'Error al obtener los datos del estudiante');
        }

        const data = await response.json();

        // Verificar si la operación fue exitosa
        if (data.status !== 'success') {
          throw new Error(data.message || 'Error desconocido al procesar estudiante');
        }

        const mensajeModo = formData.modo === 'add' ? 'agregado' : 'editado';

        // Mostrar éxito si todo fue bien
        await Swal.fire({
          title: `Estudiante ${mensajeModo}`,
          icon: 'success',
          showConfirmButton: false,
          timer: 1000
        });
        window.location.reload();

      } catch (error) {
        console.error('Error:', error);

        // Manejar todos los errores (validaciones o del servidor) en el catch
        await Swal.fire({
          title: 'Error',
          html: error.message,
          icon: 'error',
          showConfirmButton: true,
        });
      }
    });


    const btnsDeleteStudents = document.querySelectorAll('.btn-delete-student');
    btnsDeleteStudents.forEach(btn => {
      btn.addEventListener('click', async function(e) {
        e.stopPropagation();
        const StudentID = btn.dataset.studentid;

        try {
          const result = await Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, borrarlo!'
          });

          if (result.isConfirmed) {
            const response = await fetch('<?= base_url('api/delete-student') ?>', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                StudentID
              })
            });

            // Verificar si la respuesta es correcta
            if (!response.ok) {
              const errorData = await response.json();
              throw new Error(errorData.message || 'Error al eliminar el estudiante');
            }

            const data = await response.json();

            // Verificar si la operación fue exitosa
            if (data.status !== 'success') {
              throw new Error(data.message || 'Error desconocido al eliminar el estudiante');
            }

            // Mostrar éxito si todo fue bien
            await Swal.fire({
              title: 'Estudiante eliminado',
              icon: 'success',
              showConfirmButton: false,
              timer: 1500
            });

            window.location.reload();
          }

        } catch (error) {
          console.error('Error:', error);

          // Manejar todos los errores (validaciones o del servidor) en el catch
          await Swal.fire({
            title: 'Error al eliminar estudiante',
            text: error.message,
            icon: 'error',
            showConfirmButton: true,
          });
        }
      });
    });


    const btnsEditStudents = document.querySelectorAll('.btn-edit-student');
    btnsEditStudents.forEach(btn => {
      btn.addEventListener('click', async function(e) {
        e.stopPropagation();

        try {
          const StudentID = btn.dataset.studentid;

          // Realiza la solicitud fetch utilizando async/await dentro de try
          const response = await fetch('<?= base_url('api/get-student') ?>', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              StudentID
            })
          });

          // Si la respuesta no es correcta, arroja un error
          if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
          }

          // Parsear los datos
          const result = await response.json();

          // Extraer datos del estudiante
          const {
            FirstName,
            LastName,
            Cedula,
            Phone,
            Email,
            Status
          } = result.data[0];

          // Asignar los valores a formData
          formData.modo = 'edit';
          formData.StudentID = StudentID;
          formData.firstName = FirstName;
          formData.lastName = LastName;
          formData.cedula = Cedula;
          formData.phone = Phone;
          formData.email = Email;
          formData.status = parseInt(Status);

          // Renderizar los datos en el formulario y cambiar el estado del modal
          renderFormData();
          changeModalState();

        } catch (error) {
          // Manejo de errores
          Swal.fire({
            title: 'Error al obtener datos del estudiante',
            text: error.message,
            icon: 'error',
            showConfirmButton: true,
          });
        }
      });
    });


  });
</script>

<?= $this->endSection() ?>