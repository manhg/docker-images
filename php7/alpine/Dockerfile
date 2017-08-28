FROM alpine:3.6

ENV TIMEZONE            Asia/Tokyo
ENV PHP_MEMORY_LIMIT    64M
ENV MAX_UPLOAD          16M
ENV PHP_MAX_FILE_UPLOAD 200
ENV PHP_MAX_POST        20M

RUN apk add --no-cache tzdata \
		php7 \
		php7-common \
		php7-sockets \
		php7-session \
		php7-mcrypt \
		php7-mcrypt \
		php7-openssl \
		php7-pdo \
		php7-zip \
		php7-mysqli \
		php7-pdo_pgsql \
		php7-gd \
		php7-iconv \
		php7-curl \
        php7-xdebug \
		php7-fpm && \
    cp /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && \
	echo "${TIMEZONE}" > /etc/timezone && \
    
    # Set environments
	sed -i "s|;*daemonize\s*=\s*yes|daemonize = no|g" /etc/php7/php-fpm.conf && \
	sed -i "s|;*listen\s*=\s*127.0.0.1:9000|listen = 9000|g" /etc/php7/php-fpm.d/www.conf && \
	sed -i "s|;*listen\s*=\s*/||g" /etc/php7/php-fpm.d/www.conf && \
	sed -i "s|;*date.timezone =.*|date.timezone = ${TIMEZONE}|i" /etc/php7/php.ini && \
	sed -i "s|;*memory_limit =.*|memory_limit = ${PHP_MEMORY_LIMIT}|i" /etc/php7/php.ini && \
    sed -i "s|;*upload_max_filesize =.*|upload_max_filesize = ${MAX_UPLOAD}|i" /etc/php7/php.ini && \
    sed -i "s|;*max_file_uploads =.*|max_file_uploads = ${PHP_MAX_FILE_UPLOAD}|i" /etc/php7/php.ini && \
    sed -i "s|;*post_max_size =.*|post_max_size = ${PHP_MAX_POST}|i" /etc/php7/php.ini && \
    sed -i "s|;*cgi.fix_pathinfo=.*|cgi.fix_pathinfo= 0|i" /etc/php7/php.ini && \
    # Cleaning up
	mkdir /www && \
	apk del tzdata && \
	rm -rf /var/cache/apk/*

# Set Workdir
WORKDIR /var/www/html

# Expose volumes
VOLUME ["/var/www/html"]

# Expose ports
EXPOSE 9000

CMD ["/usr/sbin/php-fpm7"]
