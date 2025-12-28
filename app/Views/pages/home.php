<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="card" style="display:grid;grid-template-columns:2fr 1fr;gap:1rem;align-items:center;">
    <div>
        <p class="pill">MVP / Early Access</p>
        <h1>TopShard — топ игровых серверов</h1>
        <p class="muted">Каталог, правила, промо. Метрики онлайн и uptime подключим через cron/воркер. Тёмная тема по умолчанию.</p>
        <div style="display:flex;gap:0.75rem;margin-top:1rem;flex-wrap:wrap;">
            <a class="btn" href="/servers">Смотреть каталог</a>
            <a class="pill" href="/add">Добавить свой сервер</a>
        </div>
    </div>
    <div class="card" style="background:linear-gradient(135deg,#0f172a,#111827);border:1px solid #1f2937;">
        <h3>Рейтинг (MVP)</h3>
        <p class="muted">Score = 0.55*Online7d + 0.35*Votes24h + 0.10*Uptime30d</p>
        <p class="muted">Online/Uptime пока “нет данных”, но схема и таблицы готовы.</p>
    </div>
</section>

<section class="grid grid-2">
    <div class="card">
        <h2>Топ серверов</h2>
        <?php if (empty($topServers)) : ?>
            <p class="muted">Пока пусто.</p>
        <?php else : ?>
            <ul style="list-style:none;padding:0;margin:0;">
                <?php foreach ($topServers as $server): ?>
                    <li style="display:flex;justify-content:space-between;align-items:center;padding:0.6rem 0;border-bottom:1px solid #1f2937;">
                        <div>
                            <a href="/server/<?= esc($server['slug']) ?>"><?= esc($server['name']) ?></a>
                            <div class="muted"><?= esc($server['game']) ?> • <?= esc($server['type']) ?></div>
                        </div>
                        <span class="badge <?= esc($server['status']) ?>"><?= esc($server['status']) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="card">
        <h2>Тренды</h2>
        <p class="muted">Заглушка: появится после подключения метрик.</p>
        <ul style="list-style:none;padding:0;margin:0;">
            <?php foreach ($trendingServers as $server): ?>
                <li style="padding:0.5rem 0;border-bottom:1px solid #1f2937;">
                    <div><a href="/server/<?= esc($server['slug']) ?>"><?= esc($server['name']) ?></a></div>
                    <div class="muted"><?= esc($server['game']) ?> • нет данных по росту</div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<section class="card">
    <h2>Категории</h2>
    <div style="display:flex;gap:0.75rem;flex-wrap:wrap;">
        <?php foreach (['Lineage II','World of Warcraft','Rust','Minecraft','GTA V','Other'] as $cat): ?>
            <span class="pill"><?= esc($cat) ?></span>
        <?php endforeach; ?>
    </div>
</section>
<?= $this->endSection() ?>
