FROM php:8.2.10-fpm-bookworm
# RUN apk update && apk add zlib-dev libpng-dev oniguruma-dev curl curl-dev libwebp-dev libjpeg-turbo-dev freetype-dev libzip-dev libxml2-dev autoconf g++ make
# RUN docker-php-ext-configure gd \
#     --enable-gd \
#     --with-webp \
#     --with-jpeg \
#     --with-freetype
RUN apt update && apt install -y \
    libssl-dev \
    libcurl4-openssl-dev \
    zlib1g-dev \
    libpng-dev \
    libonig-dev \
    curl \
    libcurl4-openssl-dev \
    libwebp-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libxml2-dev \
    autoconf \
    g++ \
    make \
    # cups \
    cups-bsd \
    # lpr \
    zip \
    unzip \
    git \
    net-tools \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd \
    --enable-gd \
    --with-webp \
    --with-jpeg \
    --with-freetype

RUN docker-php-ext-install pdo pdo_mysql gd mbstring curl exif pcntl bcmath xml zip

ENV COMPOSER_ALLOW_SUPERUSER=1
WORKDIR /var/www/html
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer
COPY ./app/composer.* ./
RUN composer install --prefer-dist --no-dev --no-scripts --no-progress --no-interaction

# RUN apk add cups 

# Create a user for running CUPS
# RUN addgroup -S cups && adduser -S -G cups cups
RUN groupadd --system cups && useradd --system --gid cups cups

# Create necessary directories and set permissions
# RUN mkdir -p /var/run/cups /var/cache/cups /var/log/cups
# RUN chown -R cups:cups /etc/cups /var/run/cups /var/cache/cups /var/log/cups

# Copy CUPS configuration files if needed (optional)
# COPY cups.conf /etc/cups/cupsd.conf

# Expose CUPS port
# EXPOSE 631
EXPOSE 9000 48080
# Start CUPS service
# CMD ["/usr/sbin/cupsd", "-f"]