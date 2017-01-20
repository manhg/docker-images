FROM ubuntu:12.04

VOLUME ["/var/www"]

RUN apt-get update && \
    apt-get install -y \
      apache2 \
      php5-cli \
      libapache2-mod-php5 \
      php5-gd \
      php5-mysql \
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

EXPOSE 80
CMD ["/usr/local/bin/run"]
