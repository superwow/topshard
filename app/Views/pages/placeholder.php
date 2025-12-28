<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <h1><?= esc($title ?? 'В разработке') ?></h1>
    <p class="muted"><?= esc($message ?? 'Страница появится в следующих итерациях.') ?></p>
    <p class="muted">Следите за PR-апдейтами.</p>
</div>
<?= $this->endSection() ?>
