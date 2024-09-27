# Utilise l'image de base PHP avec Apache
FROM php:8.1-apache

# Installe les extensions nécessaires pour PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql
