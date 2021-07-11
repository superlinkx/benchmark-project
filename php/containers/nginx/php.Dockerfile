FROM php:8-fpm

ARG USER_ID=1000
RUN usermod --non-unique --uid $USER_ID www-data

COPY src/api/fpm/ /var/www/html
COPY src/ /var/www/html/src