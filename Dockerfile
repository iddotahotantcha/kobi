FROM php:8.2-cli

WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev zip \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Create .env automatically
RUN cp .env.example .env

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate key
RUN php artisan key:generate

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000
