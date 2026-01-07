# Use a specific, stable version of PHP and Alpine
FROM php:8.4-fpm-alpine

# Install PostgreSQL client libraries first
RUN apk --no-cache add libpq-dev \
    # Install the PHP extensions using the built-in scripts
    && docker-php-ext-install pdo pdo_pgsql pgsql

