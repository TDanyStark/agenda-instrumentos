<section class="bg-gray-50 dark:bg-gray-900 w-full h-screen flex items-center justify-center">
    <div class="flex flex-col items-center justify-center px-6 py-8 w-full max-w-md">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="w-32 h-auto mr-2" src="<?= base_url() ?>img/logos/maslogo.webp" alt="logo">
        </a>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Ingrese su numero de cedula
                </h1>
                <form class="space-y-4 md:space-y-6" action="/login" method="POST">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nº Cedula</label>
                        <input type="text" name="cedula" value="<?= old('cedula'); ?>" id="cedula" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1234567890" required="">
                    </div>
                    <?php if (session()->get('show_password_input')): ?>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" value="canzion" placeholder="canzion" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                    <?php endif; ?>
                    <button type="submit" class="w-full text-white bg-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Iniciar sesion</button>
                </form>
                <?php if(session()->get('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-3 rounded relative" role="alert" id="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline"><?= session()->get('error'); ?></span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3" id="btn-close">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<script>
    // limpiar el campo cedula cada vez que se coloque un punto lo quite
    document.getElementById('cedula').addEventListener('input', (e) => {
        let cedula = e.target.value;
        cedula = cedula.replace('.', '');
        // no permitir letras
        cedula = cedula.replace(/[a-zA-Z]/g, '');
        e.target.value = cedula;
    });


    // close alert
    const btnClose = document.getElementById('btn-close');
    const alert = document.getElementById('alert');
    btnClose?.addEventListener('click', () => {
        alert.remove();
    });

</script>