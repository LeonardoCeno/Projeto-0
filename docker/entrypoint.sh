#!/bin/bash
set -e

# Ensure the SQLite database file exists
touch /var/www/html/database/database.sqlite

# Ensure correct permissions on storage and cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Run migrations (safe to re-run with --force)
php artisan migrate --force

# Seed the database (only if tables are empty)
php artisan db:seed --force

exec "$@"
