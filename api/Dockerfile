FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libpq-dev

RUN docker-php-ext-install pdo pdo_pgsql pgsql

WORKDIR /app

COPY . /app

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --no-scripts --prefer-dist

COPY entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 8001

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
