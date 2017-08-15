FROM alpine:3.6

RUN adduser -D app
ENV LANG C.utf8
EXPOSE 8069 8071
RUN apk add --no-cache --virtual .build-deps \
    && apk add --no-cache \
        build-base ttf-freefont \
        curl tar bash postgresql-client su-exec nodejs \
        libxml2-dev \
        libxslt-dev \
        freetype-dev \
        jpeg-dev \
        lcms2-dev \
        openjpeg-dev \
        zlib-dev \
        libffi-dev \
        ca-certificates
        
RUN apk add --no-cache \
    libgcc libstdc++ libx11 glib libxrender libxext libintl libcrypto1.0 libssl1.0
    
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
        py2-yaml \
        nodejs-npm \
        python-dev
        
RUN npm install -g less
RUN pip install --no-cache-dir passlib pydot pyparsing reportlab suds xlwt psycogreen watchdog
RUN pip install https://github.com/Infinite-Code/PyChart/archive/master.tar.gz  
RUN apk del build-base \
        python-dev \
        libxml2-dev \
        libxslt-dev \
        freetype-dev \
        jpeg-dev \
        lcms2-dev \
        openjpeg-dev \
        zlib-dev \
        libffi-dev \
        nodejs-npm \
    && apk del .build-deps \
    && npm cache clean \
    && rm -R /tmp/npm*
ADD ./wkhtmltopdf /usr/bin/wkhtmltopdf && chmod 755 /usr/bin/wkhtmltopdf
# credit https://github.com/madnight/docker-alpine-wkhtmltopdf
# example command: su-exec app ~/odoo/odoo-bin
