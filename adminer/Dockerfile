FROM alpine:3.6

ARG VER=4.3.1

RUN apk add --no-cache wget php5-pgsql php5-mysql php5-cli
COPY php.ini /etc/php5/cli/conf.d/adminer.ini
COPY adminer /var/www
RUN wget --no-check-certificate https://github.com/vrana/adminer/releases/download/v${VER}/adminer-${VER}-en.php -O /var/www/adminer.php
EXPOSE 8000
WORKDIR /var/www/
RUN addgroup -S docker && adduser -S -g docker docker
RUN apk del wget
USER docker
CMD php5 -S 0.0.0.0:8000
