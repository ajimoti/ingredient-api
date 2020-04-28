#!/bin/bash
FILE=.env
if ! test -f "$FILE"; then
    cp .env.example .env
    composer install
    php artisan key:generate
    # php artisan migrate
    # php artisan db:seed
fi

# docker-compose -f docker-compose.yml up -d
