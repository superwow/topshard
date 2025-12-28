<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1>Каталог серверов</h1>
<p class="muted">Фильтры по игре, типу, рейтам и региону. Только активные.</p>

<form method="get" class="filters card">
    <div>
        <label class="muted">Игра</label>
        <input class="input" type="text" name="game" value="<?= esc($filters['game'] ?? '') ?>" placeholder="Lineage II, Rust, WoW...">
    </div>
    <div>
        <label class="muted">Тип</label>
        <input class="input" type="text" name="type" value="<?= esc($filters['type'] ?? '') ?>" placeholder="pvp/pve/rp">
    </div>
    <div>
        <label class="muted">Рейты</label>
        <input class="input" type="text" name="rates" value="<?= esc($filters['rates'] ?? '') ?>" placeholder="x1, x5, 2x">
    </div>
    <div>
        <label class="muted">Регион</label>
        <input class="input" type="text" name="region" value="<?= esc($filters['region'] ?? '') ?>" placeholder="EU/NA/CIS">
    </div>
    <div style="align-self:end;">
        <button class="btn" type="submit">Применить</button>
    </div>
</form>

<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th>Сервер</th>
                <th>Игра</th>
                <th>Тип</th>
                <th>Рейты</th>
                <th>Регион</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($servers)) : ?>
            <tr><td colspan="5" class="muted">Серверы не найдены.</td></tr>
        <?php else : ?>
            <?php foreach ($servers as $server): ?>
                <tr>
                    <td><a href="/server/<?= esc($server['slug']) ?>"><?= esc($server['name']) ?></a></td>
                    <td><?= esc($server['game']) ?></td>
                    <td><?= esc($server['type']) ?></td>
                    <td><?= esc($server['rates'] ?? '—') ?></td>
                    <td><?= esc($server['region'] ?? '—') ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
    <div style="margin-top:1rem;">
        <?= $pager->links() ?>
    </div>
</div>
<?= $this->endSection() ?>
