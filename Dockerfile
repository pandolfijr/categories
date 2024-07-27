# Use a imagem oficial do PHP com suporte a FPM
FROM php:8.2-cli

# Instale dependências do sistema e PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

# Defina o diretório de trabalho
WORKDIR /var/www/html

# Copie o composer para a imagem
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie o conteúdo do projeto para a imagem
COPY . .

# Instale as dependências do PHP (Composer)
RUN composer install

# Exponha a porta 8000 para o servidor embutido
EXPOSE 8000

# Comando para iniciar o servidor embutido do PHP
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
