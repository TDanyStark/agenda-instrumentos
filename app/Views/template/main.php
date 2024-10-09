<aside id="aside" class="bg-gray-700 text-white w-64 min-w-64 min-h-screen flex flex-col justify-between p-4 md:p-8">
  <div class="space-y-10">
    <section class="flex justify-between items-center">
      <span id="menu-hamburguer" class="cursor-pointer p-2 md:hidden">
        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M4 6H20M4 12H14M4 18H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </span>
      <div class="onlyfull">
        <img class="w-32 h-auto mx-auto" src="<?= base_url() ?>img/logos/maslogo.webp" alt="logo">
      </div>
    </section>
    <section class="onlyfull">
      <?php if (session()->get("role") == "admin"): ?>
        <ul class="space-y-6 secciones">
          <li><a href="/inicio" class="prevsalto px-4 py-2 hover:bg-primary hover:text-white hover:font-semibold rounded-xl" data-text="Inicio">Inicio</a></li>
          <li><a href="/matriculas" class="prevsalto px-4 py-2 hover:bg-primary hover:text-white hover:font-semibold rounded-xl" data-text="Matriculas">Matriculas</a></li>
          <li><a href="/estudiantes" class="prevsalto px-4 py-2 hover:bg-primary hover:text-white hover:font-semibold rounded-xl" data-text="Estudiantes">Estudiantes</a></li>
          <li><a href="/profesores" class="prevsalto px-4 py-2 hover:bg-primary hover:text-white hover:font-semibold rounded-xl" data-text="Profesores">Profesores</a></li>
          <li><a href="/instrumentos" class="prevsalto px-4 py-2 hover:bg-primary hover:text-white hover:font-semibold rounded-xl" data-text="Instrumentos">Instrumentos</a></li>
          <li><a href="/salones" class="prevsalto px-4 py-2 hover:bg-primary hover:text-white hover:font-semibold rounded-xl" data-text="Salones">Salones</a></li>
          <li><a href="/cursos" class="prevsalto px-4 py-2 hover:bg-primary hover:text-white hover:font-semibold rounded-xl" data-text="Cursos">Cursos</a></li>
          <li><a href="/semestres" class="prevsalto px-4 py-2 hover:bg-primary hover:text-white hover:font-semibold rounded-xl" data-text="Semestres">Semestres</a></li>
          <li><a href="/configuraciones" class="prevsalto px-4 py-2 hover:bg-primary hover:text-white hover:font-semibold rounded-xl" data-text="Configuraciones">Configuraciones</a></li>

        </ul>
      <?php elseif (session()->get("role") == "student"): ?>
        <ul class="space-y-6 secciones">
          <li><a href="/horarios" class="prevsalto px-4 py-2 hover:bg-primary hover:text-white hover:font-semibold rounded-xl" data-text="Horarios">Horarios</a></li>
        </ul>
      <?php endif; ?>
    </section>
  </div>
  <section class="onlyfull">
    <a href="/logout" class="px-4 py-2 flex gap-2">
      <span class="my-auto">
        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M9 20.7499H6C5.65324 20.7647 5.30697 20.7109 4.98101 20.5917C4.65505 20.4725 4.3558 20.2902 4.10038 20.0552C3.84495 19.8202 3.63837 19.5371 3.49246 19.2222C3.34654 18.9073 3.26415 18.5667 3.25 18.2199V5.77994C3.26415 5.43316 3.34654 5.09256 3.49246 4.77765C3.63837 4.46274 3.84495 4.17969 4.10038 3.9447C4.3558 3.70971 4.65505 3.52739 4.98101 3.40818C5.30697 3.28896 5.65324 3.23519 6 3.24994H9C9.19891 3.24994 9.38968 3.32896 9.53033 3.46961C9.67098 3.61027 9.75 3.80103 9.75 3.99994C9.75 4.19886 9.67098 4.38962 9.53033 4.53027C9.38968 4.67093 9.19891 4.74994 9 4.74994H6C5.70307 4.72412 5.4076 4.81359 5.17487 4.99977C4.94213 5.18596 4.78999 5.45459 4.75 5.74994V18.2199C4.78999 18.5153 4.94213 18.7839 5.17487 18.9701C5.4076 19.1563 5.70307 19.2458 6 19.2199H9C9.19891 19.2199 9.38968 19.299 9.53033 19.4396C9.67098 19.5803 9.75 19.771 9.75 19.9699C9.75 20.1689 9.67098 20.3596 9.53033 20.5003C9.38968 20.6409 9.19891 20.7199 9 20.7199V20.7499Z" fill="currentColor" />
          <path d="M16 16.7499C15.9015 16.7504 15.8038 16.7312 15.7128 16.6934C15.6218 16.6556 15.5392 16.6 15.47 16.5299C15.3296 16.3893 15.2507 16.1987 15.2507 15.9999C15.2507 15.8012 15.3296 15.6105 15.47 15.4699L18.94 11.9999L15.47 8.52991C15.3963 8.46125 15.3372 8.37845 15.2962 8.28645C15.2552 8.19445 15.2332 8.09513 15.2314 7.99443C15.2296 7.89373 15.2482 7.7937 15.2859 7.70031C15.3236 7.60692 15.3797 7.52209 15.451 7.45087C15.5222 7.37965 15.607 7.32351 15.7004 7.28579C15.7938 7.24807 15.8938 7.22954 15.9945 7.23132C16.0952 7.23309 16.1945 7.25514 16.2865 7.29613C16.3785 7.33712 16.4613 7.39622 16.53 7.46991L20.53 11.4699C20.6705 11.6105 20.7493 11.8012 20.7493 11.9999C20.7493 12.1987 20.6705 12.3893 20.53 12.5299L16.53 16.5299C16.4608 16.6 16.3782 16.6556 16.2872 16.6934C16.1962 16.7312 16.0985 16.7504 16 16.7499Z" fill="currentColor" />
          <path d="M20 12.75H9C8.80109 12.75 8.61032 12.671 8.46967 12.5303C8.32902 12.3897 8.25 12.1989 8.25 12C8.25 11.8011 8.32902 11.6103 8.46967 11.4697C8.61032 11.329 8.80109 11.25 9 11.25H20C20.1989 11.25 20.3897 11.329 20.5303 11.4697C20.671 11.6103 20.75 11.8011 20.75 12C20.75 12.1989 20.671 12.3897 20.5303 12.5303C20.3897 12.671 20.1989 12.75 20 12.75Z" fill="currentColor" />
        </svg>
      </span>
      <span>
        Salir
      </span>
    </a>
  </section>
</aside>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const menuHamburguer = document.getElementById('menu-hamburguer');
    const aside = document.getElementById('aside');
    const onlyfull = document.querySelectorAll('.onlyfull');
    const links = document.querySelectorAll('.secciones a');

  

    const mobileview = () => {
      aside.classList.toggle('w-64');
      aside.classList.toggle('min-w-64');
      aside.classList.toggle('min-h-screen');
      onlyfull.forEach(link => {
        link.classList.toggle('hidden');
      });
    }

    menuHamburguer.addEventListener('click', () => {
      mobileview();
    });

    // si el ancho de la pantalla es menor a 768px
    if (window.innerWidth < 768) {
      mobileview();
    }

    // detectar la url y colocar el active segun el data-text
    let url = window.location.pathname;
    url = url.split('/')[1];
    links.forEach(link => {
      if (link.getAttribute('data-text').toLowerCase() == url) {
        link.classList.add('active');
      }
    });
  });
</script>

<main class="p-4 md:pt-12 md:px-10 2xl:min-w-[1200px] max-w-full mx-auto min-h-screen">
  <?= $this->renderSection('content') ?>
</main>