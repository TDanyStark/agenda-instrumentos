<?= $this->extend('template\main') ?>

<?= $this->section('content') ?>

<section class="flex flex-col gap-8 w-full">
	<h1 class="text-white text-6xl font-bold">Cursos</h1>

	<div class="flex justify-end">
		<button data-modal-target="default-modal" data-modal-toggle="default-modal" id="openModal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
			Agregar nuevo curso
		</button>
	</div>

	<div class="relative overflow-x-auto max-w-full">
		<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
			<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
				<tr>
					<th scope="col" class="px-6 py-3">
						Curso
					</th>
					<th scope="col" class="px-6 py-3">
						Duración
					</th>
					<th scope="col" class="px-6 py-3">
						AC
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($cursos as $curso) : ?>
					<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
						<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
							<?= $curso->CourseName ?>
						</th>
						<td class="px-6 py-4">
							<?= $curso->ClassDuration ?>
						</td>
						<td class="px-6 py-4">
							<button class="btn-delete text-red-600 hover:text-red-900" data-cursoid="<?= $curso->CourseID ?>">Eliminar</button>
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
						Agregar curso
					</h3>
					<button type="button" id="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
						<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
						</svg>
						<span class="sr-only">Close modal</span>
					</button>
				</div>

				<!-- Modal body -->
				<!-- Modal body -->
				<section class="p-4 md:p-8">
					<div class="mb-5">
						<label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre curso</label>
						<input type="text" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
					</div>
					<div class="mb-5">
						<label for="duracion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Duración curso (minutos)</label>
						<select id="duracion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
							<option>30</option>
							<option>60</option>
						</select>
					</div>
					<!-- Nuevo campo para los días de la semana -->
					<div class="mb-5">
						<label for="dias" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Días de la semana</label>
						<select id="dias" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
							<option selected>Agregue un día</option>
							<option value="Lunes">Lunes</option>
							<option value="Martes">Martes</option>
							<option value="Miercoles">Miércoles</option>
							<option value="Jueves">Jueves</option>
							<option value="Viernes">Viernes</option>
							<option value="Sabado">Sábado</option>
							<option value="Domingo">Domingo</option>
						</select>
						<div id="dias-agregados" class="w-2/3 mt-2"></div>
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
	const modalAddCourse = document.getElementById('modal-add');

	const $nombre = document.getElementById('nombre');
	const $duracion = document.getElementById('duracion');

	// Nuevas referencias para los días
	const selectDias = document.getElementById('dias');
	const diasAgregados = document.getElementById('dias-agregados');

	let formData = {
		CourseID: '',
		modo: 'add',
		CourseName: '',
		ClassDuration: '',
		CourseAvailableDays: []
	};

	const changeModalState = () => {
		modalAddCourse.classList.toggle('flex');
		modalAddCourse.classList.toggle('hidden');
	};

	closeModal.addEventListener('click', changeModalState);
	btnCancelar.addEventListener('click', changeModalState);

	openModal.addEventListener('click', () => {
		formData.modo = 'add';
		formData.CourseName = '';
		formData.ClassDuration = '';
		formData.CourseAvailableDays = []; // Limpiamos los días seleccionados
		renderFields();
		changeModalState();
	});

	$nombre.addEventListener('input', () => {
		formData.CourseName = $nombre.value;
	});

	$duracion.addEventListener('input', () => {
		formData.ClassDuration = $duracion.value;
	});

	// Manejador para el select de días
	selectDias.addEventListener('change', function() {
		const option = selectDias.options[selectDias.selectedIndex];
		if (option.value === 'Agregue un día') return;

		// Verificamos si el día ya ha sido agregado
		if (formData.CourseAvailableDays.includes(option.value)) {
			selectDias.value = 'Agregue un día';
			return;
		}

		formData.CourseAvailableDays.push(option.value);
		renderDias();
	});

	function renderDias() {
		diasAgregados.innerHTML = '';
		formData.CourseAvailableDays.forEach(dia => {
			const div = document.createElement('div');
			div.classList.add('flex', 'items-center', 'gap-4', 'px-4', 'rounded-lg', 'py-1');
			div.innerHTML = `
                <span class="text-white">${dia}</span>
                <button class="btn-delete-dia text-red-500 font-medium rounded-lg text-sm p-1 text-center" data-dia="${dia}">
                    <!-- Icono de eliminar -->
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
			diasAgregados.appendChild(div);

			const btnDelete = div.querySelector('.btn-delete-dia');
			btnDelete.addEventListener('click', function(e) {
				e.stopPropagation();
				formData.CourseAvailableDays = formData.CourseAvailableDays.filter(d => d !== btnDelete.dataset.dia);
				renderDias();
			});
		});
		selectDias.value = 'Agregue un día';
	}

	const renderFields = () => {
		$nombre.value = formData.CourseName;
		$duracion.value = formData.ClassDuration;
		renderDias();
	};

	const btnGuardar = document.getElementById('btn-guardar');
	btnGuardar.addEventListener('click', async () => {
		try {
			if (!formData.CourseName || !formData.ClassDuration) {
				throw new Error('Todos los campos son requeridos');
			}
			const urlApi = formData.modo === 'add' ? '<?= base_url('api/add-course') ?>' : '<?= base_url('api/update-course') ?>';

			const response = await fetch(urlApi, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify(formData)
			});

			if (!response.ok) {
				const errorData = await response.json();
				throw new Error(errorData.message || 'Error al procesar el curso');
			}

			const data = await response.json();

			if (data.status !== 'success') {
				throw new Error(data.message || 'Error desconocido al procesar el curso');
			}

			await Swal.fire({
				title: `Curso ${formData.modo === 'add' ? 'agregado' : 'editado'}`,
				icon: 'success',
				showConfirmButton: false,
				timer: 1500
			});

			window.location.reload();
		} catch (error) {
			await Swal.fire({
				title: 'Error',
				text: error.message,
				icon: 'error',
				showConfirmButton: true,
			});
		}
	});

	const btnsDelete = document.querySelectorAll('.btn-delete');
	btnsDelete.forEach(btn => {
		btn.addEventListener('click', async function() {
			const cursoId = this.dataset.cursoid;

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

				if (!result.isConfirmed) return;

				const response = await fetch('<?= base_url('api/delete-course') ?>', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json'
					},
					body: JSON.stringify({
						CourseID: cursoId
					})
				});

				if (!response.ok) {
					const errorData = await response.json();
					throw new Error(errorData.message || 'Error al eliminar el curso');
				}

				await Swal.fire({
					title: 'Curso eliminado',
					icon: 'success',
					showConfirmButton: false,
					timer: 1500
				});

				window.location.reload();
			} catch (error) {
				await Swal.fire({
					title: 'Error',
					text: 'Ocurrió un error: ' + error.message,
					icon: 'error',
					showConfirmButton: true,
				});
			}
		});
	});
</script>
<!-- <script>
	const openModal = document.getElementById('openModal');
	const closeModal = document.getElementById('closeModal');
	const btnCancelar = document.getElementById('btn-cancelar');
	const modalAddCourse = document.getElementById('modal-add');

	const $nombre = document.getElementById('nombre');
	const $duracion = document.getElementById('duracion');

	let formData = {
		CourseID: '',
		modo: 'add',
		CourseName: '',
		ClassDuration: ''
	};

	const changeModalState = () => {
		modalAddCourse.classList.toggle('flex');
		modalAddCourse.classList.toggle('hidden');
	};

	closeModal.addEventListener('click', changeModalState);
	btnCancelar.addEventListener('click', changeModalState);


	openModal.addEventListener('click', () => {
		formData.modo = 'add';
		formData.CourseName = '';
		formData.ClassDuration = '';
		renderFields();
		changeModalState();
	});


	$nombre.addEventListener('input', () => {
		formData.CourseName = $nombre.value;
		console.log(formData);

	});

	$duracion.addEventListener('input', () => {
		formData.ClassDuration = $duracion.value;
		console.log(formData);
	});


	const renderFields = () => {
		$nombre.value = formData.CourseName;
		$duracion.value = formData.ClassDuration;
	};

	const btnGuardar = document.getElementById('btn-guardar');
	btnGuardar.addEventListener('click', async () => {
		try {

			if (!formData.CourseName || !formData.ClassDuration) {
				throw new Error('Todos los campos son requeridos');
			}

			const urlApi = formData.modo === 'add' ? '<?= base_url('api/add-course') ?>' : '<?= base_url('api/update-course') ?>';

			const response = await fetch(urlApi, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify(formData)
			});

			if (!response.ok) {
				const errorData = await response.json();
				throw new Error(errorData.message || 'Error al procesar el curso');
			}

			const data = await response.json();

			if (data.status !== 'success') {
				throw new Error(data.message || 'Error desconocido al procesar el curso');
			}

			await Swal.fire({
				title: `Curso ${formData.modo === 'add' ? 'agregado' : 'editado'}`,
				icon: 'success',
				showConfirmButton: false,
				timer: 1500
			});

			window.location.reload();
		} catch (error) {
			await Swal.fire({
				title: 'Error',
				text: error.message,
				icon: 'error',
				showConfirmButton: true,
			});
		}
	});

	const btnsDelete = document.querySelectorAll('.btn-delete');
	btnsDelete.forEach(btn => {
		btn.addEventListener('click', async function() {
			const cursoId = this.dataset.cursoid;

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

				if (!result.isConfirmed) return;

				const response = await fetch('<?= base_url('api/delete-course') ?>', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json'
					},
					body: JSON.stringify({
						CourseID: cursoId
					})
				});

				if (!response.ok) {
					const errorData = await response.json();
					throw new Error(errorData.message || 'Error al eliminar el curso');
				}

				await Swal.fire({
					title: 'Curso eliminado',
					icon: 'success',
					showConfirmButton: false,
					timer: 1500
				});

				window.location.reload();
			} catch (error) {
				await Swal.fire({
					title: 'Error',
					text: 'Ocurrió un error: ' + error.message,
					icon: 'error',
					showConfirmButton: true,
				});
			}
		});
	});
</script> -->

<?= $this->endSection() ?>