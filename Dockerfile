FROM php:8.3-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

# ✅ CREATION SQLITE
RUN mkdir -p /app/database \
    && touch /app/database/database.sqlite \
    && chmod -R 777 /app/database

RUN composer install --no-dev --optimize-autoloader

RUN php artisan config:cache

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000