FROM php:7.4-fpm-alpine

WORKDIR "/application"

# Install composer instance
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

# Locales
# RUN locale-gen ru_RU.UTF-8
ENV LANG=ru_RU.UTF-8 LANGUAGE=ru_RU LC_ALL=ru_RU
