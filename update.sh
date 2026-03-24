#!/bin/bash

# =============================================================================
#  WeducaApply — Server Update Script
#  Run this script on your VPS to pull the latest changes and update the app.
#  Usage:
#    chmod +x update.sh
#    ./update.sh
# =============================================================================

set -e

APP_NAME="weducaapply"
APP_DIR="/var/www/$APP_NAME"

echo "================================================="
echo " Starting Application Update..."
echo "================================================="

# Navigate to the application directory
cd "$APP_DIR" || { echo "Directory $APP_DIR not found. Exiting."; exit 1; }

echo "[1/6] Turning on maintenance mode..."
php artisan down || true

echo "[2/6] Pulling latest changes from GitHub..."
git pull origin main

echo "[3/6] Installing/Updating Composer dependencies..."
COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader --no-interaction

echo "[4/6] Installing/Updating NPM dependencies & building assets..."
npm install
npm run build

echo "[5/6] Running database migrations..."
php artisan migrate --force

echo "[6/6] Clearing and caching application state..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

echo "Restarting queue workers..."
php artisan queue:restart || true

echo "Setting correct permissions..."
chown -R www-data:www-data "$APP_DIR"
chmod -R 775 "$APP_DIR/storage" "$APP_DIR/bootstrap/cache"

echo "Bringing application back up..."
php artisan up

echo "================================================="
echo " ✅ Application Update completed!"
echo "================================================="

echo ""
read -rp "Do you need to update the Domain / SSL Certificate? (e.g. weducaapply.rw) [Leave blank to skip]: " NEW_DOMAIN

if [ -n "$NEW_DOMAIN" ]; then
    echo "🔄 Updating Nginx & .env for $NEW_DOMAIN..."
    
    # 1. Update Laravel .env
    sed -i "s|APP_URL=.*|APP_URL=https://$NEW_DOMAIN|" "$APP_DIR/.env"
    
    # 2. Update Nginx configuration
    if [ -f "/etc/nginx/sites-available/$APP_NAME" ]; then
        sed -i "s/server_name .*/server_name $NEW_DOMAIN;/g" /etc/nginx/sites-available/$APP_NAME
        nginx -t && systemctl reload nginx
    fi
    
    # 3. Request new SSL via Certbot
    echo "🔒 Requesting SSL certificate for $NEW_DOMAIN..."
    certbot --nginx -d "$NEW_DOMAIN" --non-interactive --agree-tos --redirect --register-unsafely-without-email || echo "⚠️ Certbot encountered an issue, check logs."
    
    echo "✅ Domain & SSL updated successfully!"
fi
