# Hostinger Business deploy (Laravel + MySQL)

Shared hosting with SSH and FTP/SFTP. Keep `QUEUE_CONNECTION=sync`, file sessions/cache, and build assets before upload.

## 1. Prepare the server

1. In hPanel, create a MySQL database and user; note host, database, username, password.
2. Set PHP to **8.3+** (Laravel 12 requires 8.2+; prefer 8.3).
3. Upload the app (Git clone or SFTP/rsync) outside the old bare `public_html` layout if possible, e.g. `~/domains/yourdomain.com/laravel/`.
4. In hPanel → Domains, set the domain **document root** to `.../laravel/public`.

If you cannot change the document root, place the app under `public_html` and add a root `.htaccess`:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

Also deny web access to `.env` (Laravel’s `public/.htaccess` already protects paths outside `public/`).

## 2. Environment

Copy `.env.example` to `.env` on the server and set:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_password

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

Generate the key once: `php artisan key:generate`

## 3. Dependencies and assets

Prefer building on your machine or CI (shared hosts often OOM on Composer):

```bash
composer install --no-dev --optimize-autoloader
npm ci && npm run build
```

Upload `vendor/` and `public/build/` with the app if Composer/Node are not run on the server.

## 4. Post-deploy (SSH)

```bash
cd ~/path/to/laravel
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Ensure `storage/` and `bootstrap/cache/` are writable by the web user.

## 5. Existing MySQL data

This project’s migrations are safe against an existing `users` / `listings` schema: they add missing Laravel columns (`email_verified_at`, `remember_token`, `updated_at`, etc.) instead of dropping tables. Existing bcrypt passwords continue to work with Breeze login.

## 6. Smoke checks

- Home `/` and `/listings`
- Login/register
- Create listing while authenticated
- `/health` JSON endpoint
- Confirm `https://your-domain/.env` is not publicly readable
