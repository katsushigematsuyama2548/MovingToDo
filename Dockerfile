FROM php:8.2-fpm

# 必要なパッケージをインストール
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Composerをインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 作業ディレクトリを設定
WORKDIR /var/www

# Laravelプロジェクトを作成し、一時ディレクトリに保存
RUN composer create-project --prefer-dist laravel/laravel /tmp/laravel-project \
    && cp -r /tmp/laravel-project/* /var/www \
    && rm -rf /tmp/laravel-project