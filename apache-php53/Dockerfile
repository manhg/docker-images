FROM ubuntu:12.04

VOLUME ["/var/www"]

RUN apt-get update && \
    apt-get install -y \
      apache2 \
      libapache2-mod-php5 \
      php5-cli \
      php5-gd \
      php5-curl \
      php5-mysql \
      sendmail \
      cron \
      vim \
    && rm -rf /var/lib/apt/lists/*

COPY apache_default /etc/apache2/sites-available/default
RUN a2enmod rewrite && \
	a2enmod proxy && \
	a2enmod proxy_http && \
	a2enmod deflate && \
	a2enmod headers

ADD ./custom.ini /etc/php5/conf.d/custom.ini

EXPOSE 80
EXPOSE 7900


ENV APACHE_RUN_USER=www-data
ENV APACHE_RUN_GROUP=www-data
ENV APACHE_PID_FILE=/var/run/apache2.pid
ENV APACHE_RUN_DIR=/var/run/apache2
ENV APACHE_LOCK_DIR=/var/lock/apache2
ENV APACHE_LOG_DIR=/var/log/apache2
ENV LANG=C
CMD /usr/sbin/apache2 -DFOREGROUND