FROM debian:stretch

RUN echo "deb http://ftp.jp.debian.org/debian/ stretch main contrib non-free" > /etc/apt/sources.list.d/mirror.jp.list \
    && echo "deb http://ftp.jp.debian.org/debian/ stretch-updates main contrib" >> /etc/apt/sources.list.d/mirror.jp.list \
    && rm /etc/apt/sources.list

RUN set -x; \
        apt-get update \
        && apt-get install -y --no-install-recommends \
            locales \
            ca-certificates \
            curl \
            node-less \
            python-gevent \
            python-pip \
            python-renderpm \
            python-setuptools \
            postgresql-client \
            python \
            python-babel \
            python-dateutil \
            python-decorator \
            python-docutils \
            python-feedparser \
            python-imaging \
            python-jinja2 \
            python-ldap \
            python-libxslt1 \
            python-lxml \
            python-mako \
            python-mock \
            python-openid \
            python-passlib \
            python-psutil \
            python-psycopg2 \
            python-pychart \
            python-pydot \
            python-pyparsing \
            python-pypdf2 \
            python-reportlab \
            python-requests \
            python-suds \
            python-tz \
            python-vatnumber \
            python-vobject \
            python-werkzeug \
            python-xlsxwriter \
            python-xlwt \
            python-yaml \
        && localedef -i en_US -c -f UTF-8 -A /usr/share/locale/locale.alias en_US.UTF-8 \
        && apt-get clean
ENV LANG en_US.utf8
RUN pip install --upgrade --no-cache-dir pip setuptools wheel virtualenv

ADD ./requirements.txt /tmp/requirements.txt
RUN pip install --no-cache-dir -r /tmp/requirements.txt