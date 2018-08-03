FROM debian:9
ENV DEBIAN_FRONTEND noninteractive
RUN apt-get update && \
    apt-get install -y \
      apache2 \
      php7.0-cli \
      php7.0-gd \
      php7.0-curl \
      php7.0-mysql \
      php7.0-zip \
      libapache2-mod-php7.0 \
      cron \
      vim \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite && \
	a2enmod proxy && \
	a2enmod proxy_http && \
	a2enmod deflate && \
	a2enmod headers

ENV LANG=en_US.UTF-8
ENV APACHE_RUN_USER=www-data
ENV APACHE_RUN_GROUP=www-data
ENV APACHE_PID_FILE=/var/run/apache2.pid
ENV APACHE_RUN_DIR=/var/run/apache2
ENV APACHE_LOCK_DIR=/var/lock/apache2
ENV APACHE_LOG_DIR=/var/log/apache2
CMD /usr/sbin/apache2 -DFOREGROUND