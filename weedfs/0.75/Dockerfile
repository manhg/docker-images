FROM frolvlad/alpine-glibc:alpine-3.5

# add our user and group first to make sure their IDs get assigned consistently, regardless of whatever dependencies get added
RUN addgroup -S docker && adduser -S -G docker docker

# grab su-exec for easy step-down from root
RUN apk add --no-cache 'su-exec>=0.2'

RUN apk add --no-cache --virtual=build-dependencies --update curl wget ca-certificates && \
    wget -P /tmp https://github.com/chrislusf/seaweedfs/releases/download/0.75/linux_amd64.tar.gz && \
    tar -C /usr/bin/ -xzvf /tmp/linux_amd64.tar.gz && \
    apk del curl wget ca-certificates build-dependencies && \
    rm -rf /tmp/*

EXPOSE 8000
EXPOSE 8001
EXPOSE 9333

RUN mkdir /data && chown docker:docker /data
VOLUME /data
WORKDIR /data

CMD exec su-exec weed server -dir=/data -filer -filer.port=8000 -master.port=9333 -volume.port=8001