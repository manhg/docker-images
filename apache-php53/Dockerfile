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
      php5-memcache \
      php5-apc \
      sendmail \
      vim \
    && rm -rf /var/lib/apt/lists/*

COPY apache_default /etc/apache2/sites-available/default
COPY run /usr/local/bin/run
RUN chmod +x /usr/local/bin/run
RUN a2enmod rewrite && \
	a2enmod proxy && \
	a2enmod proxy_http && \
	a2enmod deflate && \
	a2enmod headers

ADD ./custom.ini /etc/php5/conf.d/custom.ini

EXPOSE 80
EXPOSE 7900
CMD ["/usr/local/bin/run"]

