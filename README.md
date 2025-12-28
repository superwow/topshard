# TopShard (MVP, CodeIgniter 4)

TopShard — каталог игровых серверов (Lineage II, WoW, Rust, Minecraft, GTA и др.). Этот репозиторий содержит MVP на CodeIgniter 4 с тёмной темой, базовыми страницами и схемой БД.

## Что внутри (PR1)
- Стартовый каркас CodeIgniter 4 (PHP 8.2+), строгая структура `app/`, `public/`, `writable/`.
- Статические страницы: главная `/`, каталог `/servers`, правила `/rules`, промо `/promo`, about `/about`.
- Миграции и сиды для таблиц `servers`, `votes`, `metrics_daily`, `reports`.
- Базовые вьюшки и layout в тёмной теме, заглушки под метрики/графики.

## Требования
- PHP 8.2+
- MySQL 8+ (или совместимый MariaDB)
- Composer

## Запуск локально
```bash
composer install
cp .env.example .env
php spark key:generate

# настройте подключение к базе в .env
php spark migrate
php spark db:seed DatabaseSeeder

php spark serve --host=0.0.0.0 --port=8080
# откройте http://localhost:8080/
```

## Страницы
- `/` — hero, топ, тренды (заглушки).
- `/servers` — каталог с фильтрами (game/type/rates/region), только активные.
- `/server/{slug}` — карточка сервера (появится в PR2).
- `/add` — добавление сервера (PR3).
- `/admin` — модерация (PR3), auth по паролю из `.env` (`app.adminPassword`).
- `/rules`, `/promo`, `/about` — статические страницы.

## Миграции (MVP)
- `servers` — основная таблица.
- `votes` — голоса (1 раз / 24ч — в будущих PR).
- `metrics_daily` — онлайн/аптайм (будет обновляться воркером).
- `reports` — жалобы на серверы.

## Seed-данные
Файл `app/Database/Seeds/ServerSeeder.php` — 5 демо-серверов с разными играми/типами. После `db:seed` появятся в каталоге.

## Тестирование
Базовые HTTP-тесты появятся в следующих PR. Сейчас можно проверить вручную:
```bash
php spark serve
# открыть http://localhost:8080/ и http://localhost:8080/servers
```

## Логи и метрики
- Включён отдельный канал `metrics` (папка `writable/logs/metrics/`) — пока заглушка для будущего cron/воркера.
- TODO: подключить сбор метрик через `spark metrics:collect` (PR7).

## TODO в следующих этапах
- Реальный каталог и страница сервера с фильтрами/пагинацией (PR2).
- Добавление серверов и админ-модерация (PR3).
- Голосование и лимиты (PR4).
- Рейтинг и тренды (PR5).
- Жалобы и расширенные правила (PR6).
- Cron-команда для метрик (PR7).
