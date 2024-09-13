<?= $this->extend('template\main') ?>

<?= $this->section('content') ?>
<section class="flex flex-col gap-8 w-full">
    <h1 class="text-white text-6xl font-bold">Instrumentos</h1>

    <div class="flex justify-end">
        <button data-modal-target="default-modal" data-modal-toggle="default-modal" id="openModal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
            Agregar nuevo instrumento
        </button>
    </div>



    <div class="relative overflow-x-auto max-w-full">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Instrumento
                    </th>
                    <th scope="col" class="px-6 py-3">
                        AC
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($instruments as $instrument) : ?>
                    <tr class="bg-white dark:bg-gray-800">
                        <td class="px-6 py-4">
                            <?= $instrument->InstrumentID ?>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= $instrument->InstrumentName ?>
                        </td>
                        <td class="px-6 py-4">
                            <button data-id="<?= $instrument->InstrumentID ?>" class="btn-delete text-red-600 hover:text-red-900" type="button">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
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
                        Agregar instrumento
                    </h3>
                    <button type="button" id="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <section class="p-4 md:p-8">
                    <div class="mb-5">
                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Instrumento</label>
                        <input type="text" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                </section>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button id="btn-guardar" data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear</button>
                    <button id="btn-cancelar" data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const openModal = document.getElementById('openModal');
    const closeModal = document.getElementById('closeModal');
    const btnCancelar = document.getElementById('btn-cancelar');
    const modalAdd = document.getElementById('modal-add');
    const contenedorPopup = document.getElementById('contenedor-popup');

    const changeModalState = () => {
        modalAdd.classList.toggle('flex');
        modalAdd.classList.toggle('hidden');
    }

    openModal.addEventListener('click', changeModalState);

    closeModal.addEventListener('click', changeModalState);

    btnCancelar.addEventListener('click', changeModalState);

    modalAdd.addEventListener('click', function(e) {
        if (!contenedorPopup.contains(e.target)) {
            changeModalState();
        }
    });

    const btnGuardar = document.getElementById('btn-guardar');

    btnGuardar.addEventListener('click', () => {
        const nombre = document.getElementById('nombre').value;

        if (nombre.trim() === '') {
            alert('El campo nombre es requerido');
            return;
        }

        fetch('<?= base_url('api/add-instrument') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                InstrumentName: nombre
            })
        }).then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        title: 'Instrumento agregado',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.reload();
                    });
                }
            });
    });

    const btnsDelete = document.querySelectorAll('.btn-delete');

    btnsDelete.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');

            fetch('<?= base_url('api/delete-instrument') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    InstrumentID: id
                })
            }).then(response => response.json())
                .then(data => {
                    if (data.status === 'error') {
                        throw new Error(data.message);
                    }
                    if (data.status === 'success') {
                        Swal.fire({
                            title: 'Instrumento eliminado',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                }).catch(error => {
                    Swal.fire({
                        title: 'Error',
                        text: error.message,
                        icon: 'error',
                        showConfirmButton: true,
                    });
                });
        });
    });

</script>
<?= $this->endSection() ?>