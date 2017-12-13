FROM alpine:3.6

ENV LANG C.utf8
EXPOSE 5000
RUN apk add --no-cache imagemagick libssl1.0 \
        ca-certificates curl tar rsync su-exec \
        python3 py3-pip

RUN apk add --no-cache --virtual .build-deps \
        python3-dev \
        openssl-dev \
        jpeg-dev \
        openjpeg-dev \
        zlib-dev \
        libffi-dev \
        build-base \
    && pip3 install --no-cache-dir Lektor==3.0.1 \
    && apk del .build-deps

RUN addgroup -S docker && adduser -S -g docker docker

CMD su-exec docker lektor server