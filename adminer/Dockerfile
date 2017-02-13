FROM alpine:3.4

RUN apk add --no-cache curl php5-pgsql php5-mysql php5-cli php5-mssql
COPY php.ini /etc/php5/cli/conf.d/adminer.ini
COPY adminer /var/www
EXPOSE 80
WORKDIR /var/www/
ENTRYPOINT php -S 0.0.0.0:80
