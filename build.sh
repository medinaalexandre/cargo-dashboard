#!/usr/bin/bash
cd api && cp .env.example .env \
&& docker-compose up --build -d \
&& docker compose exec php-fpm composer install \
&& docker compose exec php-fpm php artisan key:generate \
&& docker compose exec php-fpm php artisan migrate:fresh --seed