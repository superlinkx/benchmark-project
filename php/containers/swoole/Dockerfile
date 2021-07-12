FROM phpswoole/swoole:4.6-php8.0

ENV USER_ID=1000
RUN usermod --non-unique --uid $USER_ID www-data

COPY src/ /var/www
COPY config/swoole/etc/supervisor/service.d/swoole.conf /etc/supervisor/service.d/swoole.conf

WORKDIR /var/www/api/swoole