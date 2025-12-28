<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <p class="pill">Добавить сервер</p>
    <h1>Отправьте свой проект на модерацию</h1>
    <p class="muted">Заполните основную информацию: игра, тип, ссылки и способ подключения. После модерации сервер появится в каталоге.</p>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="card" style="border-color:#22d3ee;">
        <p style="margin:0;"><?= esc(session()->getFlashdata('success')) ?></p>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="card" style="border-color:#f87171;">
        <p style="margin:0;"><?= esc(session()->getFlashdata('error')) ?></p>
    </div>
<?php endif; ?>

<?php if ($validation && $validation->getErrors()): ?>
    <div class="card" style="border-color:#f87171;">
        <h4>Исправьте ошибки</h4>
        <ul>
            <?php foreach ($validation->getErrors() as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form class="card" method="post" action="/add">
    <?= csrf_field() ?>
    <div class="grid grid-2" style="gap:1rem;">
        <div>
            <label class="muted">Название *</label>
            <input class="input" type="text" name="name" value="<?= old('name') ?>" placeholder="Avalon L2" required>
        </div>
        <div>
            <label class="muted">Игра *</label>
            <input class="input" type="text" name="game" value="<?= old('game') ?>" placeholder="Lineage II, Rust, WoW" required>
        </div>
        <div>
            <label class="muted">Тип *</label>
            <select class="input" name="type" required>
                <option value="">Выберите</option>
                <?php foreach (['pvp', 'pve', 'rp', 'classic'] as $type): ?>
                    <option value="<?= esc($type) ?>" <?= set_select('type', $type) ?>><?= strtoupper(esc($type)) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label class="muted">Версия</label>
            <input class="input" type="text" name="version" value="<?= old('version') ?>" placeholder="Interlude, 1.20, WotLK">
        </div>
        <div>
            <label class="muted">Рейты</label>
            <input class="input" type="text" name="rates" value="<?= old('rates') ?>" placeholder="x1, x5, 2x">
        </div>
        <div>
            <label class="muted">Регион</label>
            <input class="input" type="text" name="region" value="<?= old('region') ?>" placeholder="EU, NA, CIS">
        </div>
        <div>
            <label class="muted">Язык</label>
            <input class="input" type="text" name="language" value="<?= old('language') ?>" placeholder="ru, en, es">
        </div>
        <div>
            <label class="muted">Сайт</label>
            <input class="input" type="url" name="website_url" value="<?= old('website_url') ?>" placeholder="https://example.com">
        </div>
        <div>
            <label class="muted">Discord</label>
            <input class="input" type="url" name="discord_url" value="<?= old('discord_url') ?>" placeholder="https://discord.gg/...">
        </div>
        <div>
            <label class="muted">Форум</label>
            <input class="input" type="url" name="forum_url" value="<?= old('forum_url') ?>" placeholder="https://forum.example">
        </div>
        <div>
            <label class="muted">Хост подключения</label>
            <input class="input" type="text" name="connect_host" value="<?= old('connect_host') ?>" placeholder="play.server.example">
        </div>
        <div>
            <label class="muted">Порт подключения</label>
            <input class="input" type="text" name="connect_port" value="<?= old('connect_port') ?>" placeholder="2106, 25565">
        </div>
        <div style="grid-column:span 2;">
            <label class="muted">Описание</label>
            <textarea class="input" name="description" rows="4" placeholder="Кратко о сервере, формат свободный"><?= old('description') ?></textarea>
        </div>
        <div style="grid-column:span 2;">
            <label class="muted">Особенности (каждая с новой строки)</label>
            <textarea class="input" name="features" rows="3" placeholder="События каждую неделю&#10;Без доната&#10;Дружелюбное комьюнити"><?= old('features') ?></textarea>
        </div>
    </div>
    <div style="display:flex;justify-content:flex-end;margin-top:1rem;">
        <button class="btn" type="submit">Отправить на модерацию</button>
    </div>
</form>
<?= $this->endSection() ?>
