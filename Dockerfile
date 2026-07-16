# Gunakan PHP 8.4 FPM
FROM php:8.4-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    zip \
    unzip \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        mbstring \
        xml \
        gd \
        zip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project (opsional jika build langsung)
# COPY . .

# Jalankan PHP-FPM
CMD ["php-fpm"]