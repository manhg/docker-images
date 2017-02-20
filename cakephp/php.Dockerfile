FROM alpine:3.4

RUN apk add --no-cache php5-fpm php5-pdo php5-pdo_mysql php5-intl \
    php5-mcrypt php5-mysql php5-cli php5-gd php5-phar php5-json \
    php5-xml php5-sockets php5-posix php5-openssl php5-curl

ADD php.ini /etc/php5/conf.d
ADD php-fpm.conf /etc/php5/

EXPOSE 9000
USER php

ADD https://getcomposer.org/download/1.3.2/composer.phar /usr/bin/composer
RUN chmod 755 /usr/bin/composer
RUN echo '' > /var/log/php-fpm.log && chown php:php /var/log/php-fpm.log
CMD umask 0002 \
    && php-fpm --nodaemonize
