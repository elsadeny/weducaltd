# WeducaApply

A Laravel 12 application with a Filament admin panel for managing educational institution applications.

---

## Requirements

| Tool | Version |
|------|---------|
| PHP | ^8.2 |
| Composer | ^2.x |
| Node.js | ^18.x |
| npm | ^9.x |
| SQLite **or** MySQL/PostgreSQL | — |

---

## Local Development Setup

```bash
# 1. Clone the repo
git clone <your-repo-url> weducaapply
cd weducaapply

# 2. Install PHP dependencies
composer install

# 3. Copy and configure environment
cp .env.example .env
php artisan key:generate

# 4. Run migrations
php artisan migrate

# 5. Install JS dependencies and build assets
npm install
npm run dev

# 6. Serve the app
php artisan serve
```

Visit: [http://localhost:8000](http://localhost:8000)
Admin panel: [http://localhost:8000/admin](http://localhost:8000/admin)

---

## Hosting Guide

### Option 1 — Shared Hosting (cPanel / Plesk)

> Best for: simple deployments with low traffic.

1. **Upload files** — Upload the entire project to your server (e.g. via FTP or Git). Place the contents of the `public/` folder inside `public_html/`, and the rest of the project **outside** `public_html/`.

2. **Point the document root** — In your hosting control panel, set the website's document root to `public_html/` (or wherever you placed the `public/` folder contents).

3. **Set the `.env`** — Create a `.env` file (copy from `.env.example`) and fill in your production values:
   ```env
   APP_NAME=WeducaApply
   APP_ENV=production
   APP_KEY=           # will be generated below
   APP_DEBUG=false
   APP_URL=https://yourdomain.com

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_db_name
   DB_USERNAME=your_db_user
   DB_PASSWORD=your_db_password
   ```

4. **Install dependencies on the server** via SSH:
   ```bash
   composer install --no-dev --optimize-autoloader
   php artisan key:generate
   php artisan migrate --force
   php artisan storage:link
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

5. **Build assets** (if Node.js is available on the server):
   ```bash
   npm install
   npm run build
   ```
   Otherwise, **build locally first** (`npm run build`) and upload the `public/build/` folder manually.

6. **Set folder permissions**:
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

---

### Option 2 — VPS / Dedicated Server (Ubuntu + Nginx)

> Best for: full control, better performance.

#### 1. Install server dependencies

```bash
sudo apt update && sudo apt upgrade -y
sudo apt install -y nginx php8.2-fpm php8.2-cli php8.2-mbstring php8.2-xml \
  php8.2-curl php8.2-zip php8.2-sqlite3 php8.2-mysql unzip curl git
curl -sLS https://deb.nodesource.com/setup_18.x | sudo bash -
sudo apt install -y nodejs
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

#### 2. Clone the project

```bash
cd /var/www
sudo git clone <your-repo-url> weducaapply
sudo chown -R www-data:www-data weducaapply
cd weducaapply
```

#### 3. Configure environment

```bash
cp .env.example .env
# Edit .env with your production values
nano .env
```

Key values to set:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
DB_CONNECTION=mysql   # or sqlite
```

#### 4. Install and build

```bash
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan migrate --force
php artisan storage:link
npm install && npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### 5. Nginx configuration

Create `/etc/nginx/sites-available/weducaapply`:

```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/weducaapply/public;

    index index.php;
    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable and restart:

```bash
sudo ln -s /etc/nginx/sites-available/weducaapply /etc/nginx/sites-enabled/
sudo nginx -t && sudo systemctl reload nginx
```

#### 6. Enable HTTPS with Let's Encrypt

```bash
sudo apt install certbot python3-certbot-nginx -y
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
```

---

### Option 3 — Platform as a Service (PaaS)

#### Laravel Forge + DigitalOcean / Linode / AWS
[Laravel Forge](https://forge.laravel.com) automates server provisioning, Nginx config, SSL, and deployments. Connect your Git repo and Forge handles the rest. **Recommended for production.**

#### Railway / Render
1. Connect your GitHub repo.
2. Set all required environment variables in the dashboard.
3. Add a build command: `composer install --no-dev && npm install && npm run build && php artisan migrate --force`
4. Set start command: `php artisan serve --host=0.0.0.0 --port=$PORT`

> **Note:** For Railway/Render, switch from SQLite to a managed MySQL or PostgreSQL database.

---

## Queue Worker (Production)

If you use queued jobs or notifications, run the queue worker as a background process. With **Supervisor**:

```bash
sudo apt install supervisor -y
```

Create `/etc/supervisor/conf.d/weducaapply-worker.conf`:

```ini
[program:weducaapply-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/weducaapply/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
numprocs=1
user=www-data
redirect_stderr=true
stdout_logfile=/var/www/weducaapply/storage/logs/worker.log
```

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start weducaapply-worker:*
```

---

## Deployment Checklist

- [ ] `APP_ENV=production` and `APP_DEBUG=false`
- [ ] `APP_KEY` is set
- [ ] Database credentials are correct
- [ ] `php artisan migrate --force` has been run
- [ ] `php artisan storage:link` has been run
- [ ] Assets are built (`npm run build`)
- [ ] Caches are cleared and rebuilt (`config:cache`, `route:cache`, `view:cache`)
- [ ] `storage/` and `bootstrap/cache/` are writable
- [ ] SSL certificate is installed
- [ ] Queue worker is running (if using queues)

---

## Admin Panel

The Filament admin panel is accessible at `/admin`. Create the first admin user with:

```bash
php artisan make:filament-user
```

---

## License

MIT
