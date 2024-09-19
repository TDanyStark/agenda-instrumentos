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
                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" class="text-orange-400" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.05 2.53004L4.03002 6.46004C2.10002 7.72004 2.10002 10.54 4.03002 11.8L10.05 15.73C11.13 16.44 12.91 16.44 13.99 15.73L19.98 11.8C21.9 10.54 21.9 7.73004 19.98 6.47004L13.99 2.54004C12.91 1.82004 11.13 1.82004 10.05 2.53004Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M5.63 13.08L5.62 17.77C5.62 19.04 6.6 20.4 7.8 20.8L10.99 21.86C11.54 22.04 12.45 22.04 13.01 21.86L16.2 20.8C17.4 20.4 18.38 19.04 18.38 17.77V13.13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M21.4 15V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="text-xl"><?= $enroll->CourseName ?></span>
              </div>
              <?php if ($enroll->ScheduleID !== null): ?>
                <div class="flex items-center space-x-2">
                  <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" class="text-yellow-400" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 13H16C17.7107 13 19.1506 14.2804 19.3505 15.9795L20 21.5M8 13C5.2421 12.3871 3.06717 10.2687 2.38197 7.52787L2 6M8 13V18C8 19.8856 8 20.8284 8.58579 21.4142C9.17157 22 10.1144 22 12 22C13.8856 22 14.8284 22 15.4142 21.4142C16 20.8284 16 19.8856 16 18V17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                  </svg>
                  <span><?= $enroll->ProfessorName ? $enroll->ProfessorName : "❌" ?></span>
                </div>
                <div class="flex items-center space-x-2">
                  <svg width="24px" height="24px" viewBox="0 0 192 192" xmlns="http://www.w3.org/2000/svg" fill="none" class="text-violet-400">
                    <path stroke="currentColor" stroke-width="12" d="M96 22a51.88 51.88 0 0 0-36.77 15.303A52.368 52.368 0 0 0 44 74.246c0 16.596 4.296 28.669 20.811 48.898a163.733 163.733 0 0 1 20.053 28.38C90.852 163.721 90.146 172 96 172c5.854 0 5.148-8.279 11.136-20.476a163.723 163.723 0 0 1 20.053-28.38C143.704 102.915 148 90.841 148 74.246a52.37 52.37 0 0 0-15.23-36.943A51.88 51.88 0 0 0 96 22Z" />
                    <circle cx="96" cy="74" r="20" stroke="currentColor" stroke-width="12" />
                  </svg>
                  <span><?= $enroll->RoomName ? $enroll->RoomName : "❌" ?></span>
                </div>
                <div class="flex items-center space-x-2">
                  <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" class="text-lime-500" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 10H21M7 3V5M17 3V5M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <span><?= $enroll->DayOfWeek ? $enroll->DayOfWeek : "❌" ?></span>
                </div>
                <div class="flex items-center space-x-2">
                  <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" class="text-teal-500" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 7V12L14.5 10.5M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <span><?= $enroll->StartTime && $enroll->EndTime ? $enroll->StartTime . ' - ' . $enroll->EndTime : "❌" ?></span>
                </div>
              <?php endif ?>

            </div>
          </div>
          <?php if ($enroll->ScheduleID === null): ?>
            <div class="bg-gray-800 p-4 flex items-center justify-center">
              <button class="py-2 px-4 w-full text-center bg-primary text-white rounded text-xl">Seleccionar Horario</button>
            </div>
          <?php endif ?>
        </div>
      <?php endforeach ?>
    </div>

    <div class="horarios text-white">
    </div>

  <?php endif ?>
</section>

<?= $this->endSection() ?>