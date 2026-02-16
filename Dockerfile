FROM php:8.3-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

# Copier env
RUN cp .env.example .env

# Créer sqlite
RUN mkdir -p /app/database \
    && touch /app/database/database.sqlite \
    && chmod -R 777 /app/database

# Installer dépendances SANS scripts
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Générer clé
RUN php artisan key:generate

# Cache config
RUN php artisan config:cache

CMD php artisan serve --host=0.0.0.0 --port=10000
