<?= $this->extend('template\main') ?>

<?= $this->section('content') ?>
<h1 class="text-white text-6xl font-bold">Inicio</h1>
<p class="text-white">Welcome back <?= session()->get("role") ?></p>
<?= $this->endSection() ?>