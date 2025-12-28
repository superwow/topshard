<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card" style="display:flex;justify-content:space-between;gap:1rem;align-items:flex-start;flex-wrap:wrap;">
    <div>
        <p class="pill">Карточка сервера</p>
        <h1><?= esc($server['name']) ?></h1>
        <p class="muted"><?= esc($server['game']) ?> • <?= esc($server['type']) ?> <?= $server['version'] ? '• ' . esc($server['version']) : '' ?></p>
        <div style="display:flex;gap:0.5rem;flex-wrap:wrap;margin-top:0.5rem;">
            <span class="pill">Регион: <?= esc($server['region'] ?? '—') ?></span>
            <span class="pill">Рейты: <?= esc($server['rates'] ?? '—') ?></span>
            <span class="pill">Язык: <?= esc(strtoupper($server['language'] ?? '—')) ?></span>
        </div>
    </div>
    <div style="display:flex;flex-direction:column;align-items:flex-end;gap:0.5rem;">
        <span class="badge <?= esc($server['status']) ?>"><?= esc($server['status']) ?></span>
        <div style="display:flex;gap:0.5rem;flex-wrap:wrap;justify-content:flex-end;">
            <?php if ($server['website_url']) : ?><a class="pill" href="<?= esc($server['website_url']) ?>" target="_blank">Сайт</a><?php endif; ?>
            <?php if ($server['discord_url']) : ?><a class="pill" href="<?= esc($server['discord_url']) ?>" target="_blank">Discord</a><?php endif; ?>
            <?php if ($server['forum_url']) : ?><a class="pill" href="<?= esc($server['forum_url']) ?>" target="_blank">Форум</a><?php endif; ?>
        </div>
    </div>
</div>

<div class="grid grid-2">
    <div class="card">
        <h3>Описание</h3>
        <p><?= esc($server['description'] ?? 'Описание пока не добавлено.') ?></p>
        <h4>Особенности</h4>
        <ul>
            <?php if (! empty($server['features'])): ?>
                <?php foreach (preg_split('/\\r?\\n/', $server['features']) as $feature): ?>
                    <li><?= esc($feature) ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="muted">Особенности не указаны.</li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="card">
        <h3>Подключение</h3>
        <p class="muted">Хост: <?= esc($server['connect_host'] ?? '—') ?><br>Порт: <?= esc($server['connect_port'] ?? '—') ?></p>
        <h3>Статистика</h3>
        <p class="muted">Online: нет данных<br>Uptime: нет данных</p>
        <?php if ($metricsPlaceholder): ?>
            <p class="muted">Графики появятся после подключения cron/worker.</p>
        <?php endif; ?>
    </div>
</div>

<?php if (! empty($relatedServers)) : ?>
    <div class="card">
        <h3>Похожие сервера</h3>
        <p class="muted">Другие проекты в игре <?= esc($server['game']) ?>.</p>
        <div style="display:flex;gap:0.75rem;flex-wrap:wrap;">
            <?php foreach ($relatedServers as $related): ?>
                <a class="pill" href="/server/<?= esc($related['slug']) ?>"><?= esc($related['name']) ?></a>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>
