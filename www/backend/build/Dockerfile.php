FROM 8.3-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    git \
    unzip \
    libxml2-dev \
    software-properties-common \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip xml \
    && docker-php-ext-install pdo pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*


# Установка Freestyle Datasource для работы с MS SQL
RUN apt-get update && apt-get install -y \
    freetds-dev \  
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Установка расширений для PDO (кросс-соблюдающий драйвер для работы с базами данных)
# Установка расширения для PDO, чтобы работать с SQL Server
RUN pecl install pdo_sqlsrv

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/backend
COPY code/ .

RUN composer install --no-interaction
RUN cp .env.example .env

EXPOSE 9000

CMD ["php-fpm"]