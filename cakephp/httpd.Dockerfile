FROM httpd:2.4-alpine
COPY php.conf /usr/local/apache2/conf
RUN echo -e "\nInclude conf/php.conf" >> /usr/local/apache2/conf/httpd.conf
