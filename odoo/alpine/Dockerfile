FROM alpine:3.6

ENV LANG C.utf8
EXPOSE 8069 8071
RUN apk add --no-cache \
        libgcc libstdc++ libx11 glib libxrender libxext libintl libcrypto1.0 libssl1.0 \
        ca-certificates ttf-freefont \
        curl tar bash postgresql-client su-exec nodejs

RUN apk add --no-cache \
        py2-gevent \
        py2-pip \
        py2-setuptools \
        py2-babel \
        py2-dateutil \
        py2-decorator \
        py2-docutils \
        py2-feedparser \
        py-imaging \
        py2-jinja2 \
        py2-lxml \
        py-mako \
        py2-mock \
        py2-psutil \
        py2-psycopg2 \
        py2-pypdf2 \
        py2-requests \
        py2-tz \
        py2-vobject \
        py2-werkzeug \
        py2-xlsxwriter \
        py2-yaml
RUN apk add --no-cache --virtual .build-deps \
        python-dev \
        libxml2-dev \
        libxslt-dev \
        freetype-dev \
        jpeg-dev \
        lcms2-dev \
        openjpeg-dev \
        zlib-dev \
        libffi-dev \
        build-base \
        nodejs-npm
RUN npm install -g less
RUN pip install --no-cache-dir \
        virtualenv passlib pydot pyparsing reportlab suds xlwt greenlet psycogreen watchdog \
        raven shortuuid pdfkit
RUN pip install https://github.com/Infinite-Code/PyChart/archive/master.tar.gz
RUN npm cache clean \
    && apk del .build-deps \
    && rm -R /tmp/npm*
ADD ./wkhtmltopdf /usr/bin/wkhtmltopdf
RUN chmod 755 /usr/bin/wkhtmltopdf

RUN addgroup -S docker && adduser -S -g docker docker
USER docker
# credit https://github.com/madnight/docker-alpine-wkhtmltopdf
# example command: su-exec app ~/odoo/odoo-bin
