FROM alpine:3.4

RUN apk add --no-cache curl php5-pgsql php5-mysql php5-cli
COPY php.ini /etc/php5/cli/conf.d/adminer.ini
COPY adminer /var/www
EXPOSE 9043
WORKDIR /var/www/
ENTRYPOINT php -S 0.0.0.0:9043
