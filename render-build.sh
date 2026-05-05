#!/usr/bin/env bash
# exit on error
set -o errexit

composer install --no-dev --no-interaction --optimize-autoloader

# Build assets using Vite
npm install
npm run build

# Run migrations
php artisan migrate --force
