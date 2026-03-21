#!/bin/bash

# =============================================================================
#  WeducaApply — VPS Bootstrap & Deploy Script
#  Run on a fresh Ubuntu 22.04 / 24.04 VPS as root or with sudo.
#  Usage:
#    chmod +x deploy.sh
#    sudo bash deploy.sh
# =============================================================================

set -e  # Exit immediately on error

# ─── CONFIGURATION ──────────────────────────────────────────────────────────
APP_NAME="weducaapply"
APP_DIR="/var/www/$APP_NAME"
NGINX_CONF="/etc/nginx/sites-available/$APP_NAME"
PHP_VERSION="8.2"
GIT_REPO="https://github.com/elsadeny/weducaltd.git"
DOMAIN="weduca.aphezis.com"

# Prompt for required values
echo ""
echo "╔══════════════════════════════════════════════════════╗"
echo "║        WeducaApply — VPS Deployment Script           ║"
echo "╚══════════════════════════════════════════════════════╝"
echo ""

echo "📦 Repo:   $GIT_REPO"
echo "🌐 Domain: $DOMAIN"
read -rp "🗄️  DB name: " DB_NAME
read -rp "🗄️  DB username: " DB_USER
read -rsp "🔑 DB password: " DB_PASS
echo ""
read -rp "📧 Your email (for SSL cert): " SSL_EMAIL

echo ""
echo "──────────────────────────────────────────────────────"
echo " Starting installation... (this takes ~5 minutes)"
echo "──────────────────────────────────────────────────────"

# ─── 1. SYSTEM UPDATE ────────────────────────────────────────────────────────
echo "[1/10] Updating system packages..."
apt-get update -q && apt-get upgrade -y -q

# ─── 2. INSTALL DEPENDENCIES ─────────────────────────────────────────────────
echo "[2/10] Installing PHP $PHP_VERSION, Nginx, MySQL, Node.js..."

apt-get install -y -q software-properties-common curl git unzip

# PHP
add-apt-repository -y ppa:ondrej/php
apt-get update -q
apt-get install -y -q \
    php${PHP_VERSION} php${PHP_VERSION}-fpm php${PHP_VERSION}-cli \
    php${PHP_VERSION}-mbstring php${PHP_VERSION}-xml php${PHP_VERSION}-curl \
    php${PHP_VERSION}-zip php${PHP_VERSION}-bcmath php${PHP_VERSION}-mysql \
    php${PHP_VERSION}-sqlite3 php${PHP_VERSION}-tokenizer \
    php${PHP_VERSION}-intl php${PHP_VERSION}-gd

# Nginx
apt-get install -y -q nginx

# MySQL
apt-get install -y -q mysql-server

# Node.js 20
curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
apt-get install -y -q nodejs

# Composer
if ! command -v composer &> /dev/null; then
    echo "Installing Composer..."
    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer
fi

# ─── 3. CONFIGURE MYSQL ──────────────────────────────────────────────────────
echo "[3/10] Setting up MySQL database..."
mysql -e "CREATE DATABASE IF NOT EXISTS \`$DB_NAME\`;"
mysql -e "CREATE USER IF NOT EXISTS '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASS';"
mysql -e "GRANT ALL PRIVILEGES ON \`$DB_NAME\`.* TO '$DB_USER'@'localhost';"
mysql -e "FLUSH PRIVILEGES;"

# ─── 4. CLONE REPOSITORY ─────────────────────────────────────────────────────
echo "[4/10] Cloning repository..."
if [ -d "$APP_DIR" ]; then
    echo "  Directory exists — pulling latest..."
    cd "$APP_DIR" && git pull
else
    git clone "$GIT_REPO" "$APP_DIR"
fi

cd "$APP_DIR"

# ─── 5. CONFIGURE ENVIRONMENT ────────────────────────────────────────────────
echo "[5/10] Configuring .env..."
if [ ! -f ".env" ]; then
    cp .env.example .env
fi

# Overwrite key values
sed -i "s|APP_ENV=.*|APP_ENV=production|" .env
sed -i "s|APP_DEBUG=.*|APP_DEBUG=false|" .env
sed -i "s|APP_URL=.*|APP_URL=https://$DOMAIN|" .env
sed -i "s|DB_CONNECTION=.*|DB_CONNECTION=mysql|" .env
sed -i "s|# DB_HOST=.*|DB_HOST=127.0.0.1|" .env
sed -i "s|# DB_PORT=.*|DB_PORT=3306|" .env
sed -i "s|# DB_DATABASE=.*|DB_DATABASE=$DB_NAME|" .env
sed -i "s|# DB_USERNAME=.*|DB_USERNAME=$DB_USER|" .env
sed -i "s|# DB_PASSWORD=.*|DB_PASSWORD=$DB_PASS|" .env

# ─── 6. INSTALL APP DEPENDENCIES ─────────────────────────────────────────────
echo "[6/10] Installing PHP & JS dependencies..."
# Remove lock file so Composer regenerates it for this server's PHP platform
rm -f composer.lock
COMPOSER_ALLOW_SUPERUSER=1 composer update --no-dev --optimize-autoloader --no-interaction --no-audit
npm install
npm run build

# ─── 7. LARAVEL SETUP ────────────────────────────────────────────────────────
echo "[7/10] Running Laravel setup commands..."
php artisan key:generate --force
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
chown -R www-data:www-data "$APP_DIR"
chmod -R 775 "$APP_DIR/storage" "$APP_DIR/bootstrap/cache"

# ─── 8. NGINX CONFIGURATION ──────────────────────────────────────────────────
echo "[8/10] Configuring Nginx..."
cat > "$NGINX_CONF" <<EOF
server {
    listen 80;
    server_name $DOMAIN;
    root $APP_DIR/public;

    index index.php;
    charset utf-8;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php${PHP_VERSION}-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOF

ln -sf "$NGINX_CONF" /etc/nginx/sites-enabled/
nginx -t && systemctl reload nginx

# ─── 9. SSL WITH LET'S ENCRYPT ───────────────────────────────────────────────
echo "[9/10] Installing SSL certificate..."
apt-get install -y -q certbot python3-certbot-nginx
certbot --nginx \
    -d "$DOMAIN" \
    --email "$SSL_EMAIL" \
    --agree-tos \
    --non-interactive \
    --redirect

# ─── 10. QUEUE WORKER WITH SUPERVISOR ────────────────────────────────────────
echo "[10/10] Setting up queue worker..."
apt-get install -y -q supervisor

cat > /etc/supervisor/conf.d/${APP_NAME}-worker.conf <<EOF
[program:${APP_NAME}-worker]
process_name=%(program_name)s_%(process_num)02d
command=php $APP_DIR/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
numprocs=1
user=www-data
redirect_stderr=true
stdout_logfile=$APP_DIR/storage/logs/worker.log
EOF

supervisorctl reread
supervisorctl update
supervisorctl start ${APP_NAME}-worker:*

# ─── DONE ────────────────────────────────────────────────────────────────────
echo ""
echo "╔══════════════════════════════════════════════════════╗"
echo "║             ✅  Deployment Complete!                 ║"
echo "╠══════════════════════════════════════════════════════╣"
echo "║  🌐  Site:   https://$DOMAIN"
echo "║  🔧  Admin:  https://$DOMAIN/admin"
echo "║"
echo "║  To create admin user, run:"
echo "║    php $APP_DIR/artisan make:filament-user"
echo "╚══════════════════════════════════════════════════════╝"
