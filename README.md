# GIGSWP

Laravel 12 job board (MySQL) with Breeze Blade authentication. Migrated from a custom PHP MVC app.

## Requirements

- PHP 8.2+ (8.3 recommended)
- Composer 2
- Node 20+
- MySQL 8+

## Local setup

```bash
cp .env.example .env
# set DB_* to your MySQL database
composer install
php artisan key:generate
php artisan migrate
npm install
npm run build
php artisan serve
```

App: http://127.0.0.1:8000

## Main features

- Home with recent listings
- Listings CRUD (`/listings`)
- Breeze auth (`/login`, `/register`) plus legacy aliases `/auth/login`, `/auth/register`
- Create/edit/delete require authentication; ownership policies are deferred (any logged-in user can mutate)
- Health JSON at `/health`

## Tests

```bash
npm run test
```

Playwright smoke test expects the app on `http://127.0.0.1:8000`.

## Docs

- [Laravel migration plan](docs/laravel-migration.md)
- [Hostinger Business deploy](docs/hostinger-deploy.md)
