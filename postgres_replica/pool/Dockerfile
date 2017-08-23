FROM alpine:3.6

RUN apk add --no-cache \
        ca-certificates libuuid openssl \
        pcre tzdata zlib \
        pgpool
ENV LANG C.utf8
RUN rm /etc/localtime && cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime
ARG USER_ID=1000
ARG GROUP_ID=500
RUN addgroup -g $GROUP_ID docker && \
    adduser -D -u $USER_ID -G docker docker && \
    umask 0027 && \
    mkdir /etc/pgpool2 /var/run/pgpool /var/log/pgpool /var/run/postgresql /var/log/postgresql/ && \
    chown docker /etc/pgpool2 /var/run/pgpool /var/log/pgpool /var/run/postgresql /var/log/postgresql
USER $USER_ID

# ADD https://raw.githubusercontent.com/pgpool/pgpool2/master/src/sample/pgpool.conf.sample-replication
ADD ./pgpool.conf /etc/pgpool2/pgpool.conf
CMD pgpool --dont-detach --config-file=/etc/pgpool2/pgpool.conf
