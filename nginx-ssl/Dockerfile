FROM alpine:3.6

RUN apk add --no-cache \
            nginx \
            tzdata \
            shadow \
            openssl \
            su-exec
RUN addgroup -S docker && adduser -S -g docker docker
ADD ./nginx.conf /etc/nginx/nginx.conf
ADD ./nginx.conf /etc/nginx/nginx.conf
ADD ./docker-entrypoint.sh /bin/docker-entrypoint.sh

RUN mkdir /etc/nginx/ssl/ \
    && chmod 755 /bin/docker-entrypoint.sh \
    && chown docker:docker /etc/nginx/ssl \
    && chmod 750 /etc/nginx/ssl/
EXPOSE 4443
WORKDIR /etc/nginx/
RUN rm /etc/localtime \
    && cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime \
    && umask 0027
VOLUME ["/www"]
VOLUME ["/var/log/nginx"]
VOLUME ["/var/lib/nginx"]
ENTRYPOINT ["/bin/docker-entrypoint.sh"]
CMD ["nginx", "-c", "/etc/nginx/nginx.conf", "-g", "daemon off;"]
