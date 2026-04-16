FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    unzip \
    curl \
    && docker-php-ext-install pdo pdo_sqlite \
    && apt-get clean

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-interaction --prefer-dist

RUN php artisan key:generate && \
    php artisan migrate --seed

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
