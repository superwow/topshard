<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card" style="display:flex;justify-content:space-between;gap:1rem;align-items:center;flex-wrap:wrap;">
    <div>
        <p class="pill">Каталог серверов</p>
        <h1>Найдите сервер под свой стиль игры</h1>
        <p class="muted">Фильтры по игре, типу, рейтам, региону и языку. В выдаче только активные сервера.</p>
    </div>
    <div style="text-align:right;">
        <p class="muted" style="margin:0;">Показываем по <?= esc($perPage) ?> на страницу</p>
        <a class="pill" href="/add">Хотите добавить свой?</a>
    </div>
</div>

<form method="get" class="filters card" style="align-items:end;">
    <div style="grid-column:span 2;">
        <label class="muted">Поиск</label>
        <input class="input" type="text" name="q" value="<?= esc($filters['q'] ?? '') ?>" placeholder="Название, игра или описание">
    </div>
    <div>
        <label class="muted">Игра</label>
        <select class="input" name="game">
            <option value="">Любая</option>
            <?php foreach ($filterOptions['game'] as $option): ?>
                <option value="<?= esc($option) ?>" <?= ($filters['game'] ?? '') === $option ? 'selected' : '' ?>>
                    <?= esc($option) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label class="muted">Тип</label>
        <select class="input" name="type">
            <option value="">Любой</option>
            <?php foreach ($filterOptions['type'] as $option): ?>
                <option value="<?= esc($option) ?>" <?= ($filters['type'] ?? '') === $option ? 'selected' : '' ?>>
                    <?= esc(strtoupper($option)) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label class="muted">Рейты</label>
        <input class="input" type="text" name="rates" value="<?= esc($filters['rates'] ?? '') ?>" placeholder="x1, x5, 2x">
    </div>
    <div>
        <label class="muted">Регион</label>
        <select class="input" name="region">
            <option value="">Любой</option>
            <?php foreach ($filterOptions['region'] as $option): ?>
                <option value="<?= esc($option) ?>" <?= ($filters['region'] ?? '') === $option ? 'selected' : '' ?>>
                    <?= esc($option) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label class="muted">Язык</label>
        <select class="input" name="language">
            <option value="">Любой</option>
            <?php foreach ($filterOptions['language'] as $option): ?>
                <option value="<?= esc($option) ?>" <?= ($filters['language'] ?? '') === $option ? 'selected' : '' ?>>
                    <?= esc(strtoupper($option)) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label class="muted">Сортировка</label>
        <select class="input" name="sort">
            <option value="new" <?= ($filters['sort'] ?? '') === 'new' ? 'selected' : '' ?>>Сначала новые</option>
            <option value="updated" <?= ($filters['sort'] ?? '') === 'updated' ? 'selected' : '' ?>>Обновленные</option>
        </select>
    </div>
    <div style="display:flex;gap:0.5rem;">
        <button class="btn" type="submit">Применить</button>
        <a class="pill" href="/servers">Сбросить</a>
    </div>
</form>

<?php if (empty($servers)) : ?>
    <div class="card">
        <p class="muted">По выбранным фильтрам ничего не найдено. Попробуйте ослабить условия или выберите другую игру.</p>
    </div>
<?php else : ?>
    <div class="grid grid-2">
        <?php foreach ($servers as $server): ?>
            <div class="card" style="display:flex;flex-direction:column;gap:0.5rem;justify-content:space-between;">
                <div>
                    <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:0.75rem;">
                        <div>
                            <p class="pill"><?= esc($server['game']) ?></p>
                            <h3 style="margin:0.25rem 0;"><?= esc($server['name']) ?></h3>
                            <p class="muted"><?= esc($server['type']) ?> <?= $server['version'] ? '• ' . esc($server['version']) : '' ?></p>
                        </div>
                        <span class="badge <?= esc($server['status']) ?>"><?= esc($server['status']) ?></span>
                    </div>
                    <p class="muted" style="margin-top:0.5rem;">
                        <?= esc(mb_strimwidth($server['description'] ?? 'Описание пока не добавлено.', 0, 140, '…')) ?>
                    </p>
                    <?php $stats = $voteStats[$server['id']] ?? ['total' => 0, 'votes_24h' => 0, 'votes_7d' => 0]; ?>
                    <div style="display:flex;gap:0.5rem;flex-wrap:wrap;margin-top:0.5rem;">
                        <span class="pill">Рейты: <?= esc($server['rates'] ?? '—') ?></span>
                        <span class="pill">Регион: <?= esc($server['region'] ?? '—') ?></span>
                        <span class="pill">Язык: <?= esc(strtoupper($server['language'] ?? '—')) ?></span>
                        <span class="pill">Голоса 24ч: <?= esc($stats['votes_24h']) ?></span>
                        <span class="pill">Голоса 7д: <?= esc($stats['votes_7d']) ?></span>
                        <span class="pill">Всего: <?= esc($stats['total']) ?></span>
                        <?php if (isset($ratings[$server['id']])): ?>
                            <span class="pill">Рейтинг: <?= esc(number_format($ratings[$server['id']], 1)) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;margin-top:0.75rem;">
                    <div class="muted">Добавлен: <?= esc(date('d.m.Y', strtotime($server['created_at']))) ?></div>
                    <a class="btn" href="/server/<?= esc($server['slug']) ?>">Открыть</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="card" style="margin-top:1rem;">
    <?= $pager->links() ?>
</div>
<?= $this->endSection() ?>
