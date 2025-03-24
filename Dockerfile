FROM php:8.1-apache

# Instala as extensões necessárias (inclui pdo_mysql)
RUN docker-php-ext-install pdo pdo_mysql
