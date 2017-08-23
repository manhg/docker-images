# -*- mode: conf -*-
FROM postgres:9.6-alpine

RUN apk add --no-cache \
        ca-certificates libuuid openssl \
        pcre tzdata zlib
RUN apk add gosu --no-cache --repository http://nl.alpinelinux.org/alpine/edge/testing
RUN rm /etc/localtime && cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime

# common settings
ENV MAX_CONNECTIONS 16
ENV WAL_KEEP_SEGMENTS 256
ENV MAX_WAL_SENDERS 5

# master/slave settings
ENV REPLICATION_ROLE master
ENV REPLICATION_USER replication
ENV REPLICATION_PASSWORD ""

# slave settings
ENV POSTGRES_MASTER_SERVICE_HOST localhost
ENV POSTGRES_MASTER_SERVICE_PORT 5432
ENV LANG C.utf8
# Evaluate vars inside PGDATA at runtime.
# For example HOSTNAME in 'ENV PGDATA=/mnt/$HOSTNAME'
# is resolved runtime rather then during build
COPY conf.d /var/lib/postgresql/postgresql.conf.d
COPY 10-config.sh /docker-entrypoint-initdb.d/
COPY 20-replication.sh /docker-entrypoint-initdb.d/
COPY docker-entrypoint.sh /usr/local/bin/
RUN sed -i 's/set -e/set -e -x\nPGDATA=$(eval echo "$PGDATA")/' /docker-entrypoint.sh

# ADD https://raw.githubusercontent.com/manhg/pg_back/master/pg_back /usr/bin/pg_back
ADD pg_back /usr/bin/
RUN chmod 750 /usr/bin/pg_back \
    && mkdir -p /var/backups/postgresql \
    && chmod 770 /var/backups/postgresql
