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
        <p class="muted">Score = 0.6*Votes7d + 0.4*Votes24h. Online/Uptime добавим позже.</p>
        <p class="muted">Сейчас считаем рейтинг и тренды по реальным голосам за 24 часа и 7 дней.</p>
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
                            <div class="muted">
                                <?= esc($server['game']) ?> • <?= esc($server['type']) ?> •
                                24ч: <?= esc($server['stats']['votes_24h'] ?? 0) ?> •
                                7д: <?= esc($server['stats']['votes_7d'] ?? 0) ?> •
                                всего: <?= esc($server['stats']['total'] ?? 0) ?> •
                                рейтинг: <?= esc(number_format($server['rating'], 1)) ?>
                            </div>
                        </div>
                        <span class="badge <?= esc($server['status']) ?>"><?= esc($server['status']) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="card">
        <h2>Тренды</h2>
        <p class="muted">Динамика по голосам за 24 часа vs. средний день за 7 дней.</p>
        <ul style="list-style:none;padding:0;margin:0;">
            <?php foreach ($trendingServers as $server): ?>
                <li style="padding:0.5rem 0;border-bottom:1px solid #1f2937;">
                    <div><a href="/server/<?= esc($server['slug']) ?>"><?= esc($server['name']) ?></a></div>
                    <div class="muted">
                        <?= esc($server['game']) ?> •
                        24ч: <?= esc($server['stats']['votes_24h'] ?? 0) ?> •
                        7д: <?= esc($server['stats']['votes_7d'] ?? 0) ?> •
                        рейтинг: <?= esc(number_format($server['rating'], 1)) ?> •
                        тренд: <?= esc(number_format($server['trendScore'], 1)) ?>
                    </div>
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
