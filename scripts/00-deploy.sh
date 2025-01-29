#!/usr/bin/env bash

echo "running composer"
composer install --no-dev --working-dir=/var/www/html

echo "optimizing"
php artisan optimize

echo "migrating"
php artisan migrate --force

echo "seeding"
php artisan db:seed