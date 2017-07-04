FROM php:5.6.30-cli

# OS and required software updates
RUN apt-get update && \
    apt-get install -y git zip unzip

WORKDIR /app

# Download latest version of composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

# Install packages
COPY composer.json composer.lock /app/
RUN php composer.phar update

# Copy over app
COPY ./ /app/

# Run tests
CMD ["vendor/bin/phpunit"]
