FROM mcr.microsoft.com/vscode/devcontainers/php:0-8

# Install Node.js
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql
