#!/bin/bash
FILE=.env
if ! test -f "$FILE"; then
    cp .env.example .env
    composer install
    php artisan key:generate
    docker-compose -f docker-compose.yml up -d
    docker exec ingredient_api /bin/sh -c "php artisan migrate; php artisan db:seed"
fi

docker-compose -f docker-compose.yml up -d
