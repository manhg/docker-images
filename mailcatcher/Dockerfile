FROM alpine:3.6

RUN apk add --no-cache ca-certificates openssl \
    ruby ruby-bigdecimal ruby-json sqlite-libs libstdc++

ARG MAILCATCHER_VERSION=0.6.5

RUN apk add --no-cache --virtual .build-deps \
        ruby-dev make g++ sqlite-dev \
        && gem install -v $MAILCATCHER_VERSION mailcatcher --no-ri --no-rdoc \
        && apk del .build-deps \
        && rm -rf /var/cache/apk/*

# smtp port & web port
EXPOSE 1025 1080

RUN addgroup -S docker && adduser -S -g docker docker
USER docker
CMD mailcatcher --foreground --smtp-ip=0.0.0.0 --smtp-port=1025 --http-ip=0.0.0.0 --http-port=1080