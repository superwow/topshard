<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card" style="display:flex;justify-content:space-between;gap:1rem;align-items:center;flex-wrap:wrap;">
    <div>
        <p class="pill">Админка</p>
        <h1>Модерируйте заявки</h1>
        <p class="muted">Отправленные через /add серверы попадают сюда со статусом pending.</p>
    </div>
    <form method="post" action="/admin/logout">
        <?= csrf_field() ?>
        <button class="btn" type="submit">Выйти</button>
    </form>
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

<div class="grid grid-2">
    <div class="card">
        <h3>Активные</h3>
        <p style="font-size:2rem;margin:0;"><?= esc($activeCount) ?></p>
        <p class="muted">В каталоге /servers.</p>
    </div>
    <div class="card">
        <h3>Ожидают модерации</h3>
        <p style="font-size:2rem;margin:0;"><?= esc($pendingCount) ?></p>
        <p class="muted">Новые заявки.</p>
    </div>
    <div class="card">
        <h3>Отключены</h3>
        <p style="font-size:2rem;margin:0;"><?= esc($disabledCount) ?></p>
        <p class="muted">Скрыты из каталога.</p>
    </div>
</div>

<div class="card">
    <h3>Новые заявки</h3>
    <?php if (empty($pendingServers)): ?>
        <p class="muted">Пока пусто. Добавьте сервер через /add.</p>
    <?php else: ?>
        <div class="grid" style="gap:1rem;">
            <?php foreach ($pendingServers as $server): ?>
                <div class="card" style="border-color:#fbbf24;">
                    <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:0.75rem;flex-wrap:wrap;">
                        <div>
                            <p class="pill"><?= esc($server['game']) ?></p>
                            <h3 style="margin:0.25rem 0;"><?= esc($server['name']) ?></h3>
                            <p class="muted"><?= esc($server['type']) ?> <?= $server['version'] ? '• ' . esc($server['version']) : '' ?></p>
                            <p class="muted" style="margin-top:0.5rem;"><?= esc($server['description'] ?: 'Описание не указано') ?></p>
                            <div style="display:flex;gap:0.5rem;flex-wrap:wrap;margin-top:0.5rem;">
                                <span class="pill">Регион: <?= esc($server['region'] ?: '—') ?></span>
                                <span class="pill">Язык: <?= esc(strtoupper($server['language'] ?: '—')) ?></span>
                                <span class="pill">Рейты: <?= esc($server['rates'] ?: '—') ?></span>
                            </div>
                        </div>
                        <span class="badge pending">pending</span>
                    </div>
                    <div style="display:flex;gap:0.5rem;flex-wrap:wrap;margin-top:0.75rem;align-items:center;justify-content:space-between;">
                        <div class="muted">Добавлен: <?= esc(date('d.m.Y H:i', strtotime($server['created_at']))) ?></div>
                        <div style="display:flex;gap:0.5rem;flex-wrap:wrap;">
                            <?php if ($server['website_url']): ?><a class="pill" href="<?= esc($server['website_url']) ?>" target="_blank">Сайт</a><?php endif; ?>
                            <?php if ($server['discord_url']): ?><a class="pill" href="<?= esc($server['discord_url']) ?>" target="_blank">Discord</a><?php endif; ?>
                            <?php if ($server['forum_url']): ?><a class="pill" href="<?= esc($server['forum_url']) ?>" target="_blank">Форум</a><?php endif; ?>
                        </div>
                    </div>
                    <div style="display:flex;gap:0.5rem;flex-wrap:wrap;justify-content:flex-end;margin-top:1rem;">
                        <form method="post" action="/admin/moderate/<?= esc($server['id']) ?>">
                            <?= csrf_field() ?>
                            <input type="hidden" name="status" value="active">
                            <button class="btn" type="submit">Одобрить</button>
                        </form>
                        <form method="post" action="/admin/moderate/<?= esc($server['id']) ?>">
                            <?= csrf_field() ?>
                            <input type="hidden" name="status" value="disabled">
                            <button class="btn" type="submit" style="background:linear-gradient(135deg,#f87171,#b91c1c);">Отклонить</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
