<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <p class="pill">Модерация</p>
    <h1>Вход в админку</h1>
    <p class="muted">Укажите пароль из <code>.env</code> (app.adminPassword). После входа будут доступны заявки из формы /add.</p>
</div>

<?php if (session()->getFlashdata('error')): ?>
    <div class="card" style="border-color:#f87171;">
        <p style="margin:0;"><?= esc(session()->getFlashdata('error')) ?></p>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="card" style="border-color:#22d3ee;">
        <p style="margin:0;"><?= esc(session()->getFlashdata('success')) ?></p>
    </div>
<?php endif; ?>

<form class="card" method="post" action="/admin/login" style="max-width:520px;">
    <?= csrf_field() ?>
    <div>
        <label class="muted">Пароль</label>
        <input class="input" type="password" name="password" placeholder="••••••••" required>
    </div>
    <div style="margin-top:1rem;display:flex;justify-content:flex-end;">
        <button class="btn" type="submit">Войти</button>
    </div>
</form>
<?= $this->endSection() ?>
