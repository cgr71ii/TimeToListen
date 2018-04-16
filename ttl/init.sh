#!/bin/bash

composer update
cp .env.example .env
touch database/database.sqlite
php artisan migrate:install
php artisan migrate --seed
php artisan key:generate
