FROM debian:stretch-slim

ENV DEBIAN_FRONTEND noninteractive
ADD https://ngxpagespeed.com/install /tmp/install.sh
RUN sed -i 's/apt-get install/apt-get install -y /' /tmp/install.sh
ARG NGINX_VERSION=1.12.1
ARG NGINX_PARAM="--prefix=/etc/nginx --conf-path=/etc/nginx/nginx.conf --sbin-path=/usr/bin/nginx --pid-path=/run/nginx.pid --lock-path=/run/lock/nginx.lock --user=http --group=http --http-log-path=/var/log/nginx/access.log --error-log-path=stderr --with-pcre-jit --with-file-aio --with-http_addition_module --with-http_auth_request_module --with-http_degradation_module --with-http_gunzip_module --with-http_gzip_static_module --with-http_realip_module --with-http_secure_link_module --with-http_slice_module --with-http_ssl_module --with-http_stub_status_module --with-http_sub_module --with-http_v2_module --with-mail --with-mail_ssl_module --with-stream --with-stream_ssl_module --with-threads --with-ipv6"
RUN apt-get update && apt-get install -y --no-install-recommends \
        sudo wget ca-certificates \
        build-essential \
        openssl \
        libssl-dev \
        zlib1g-dev \
        libpcre3 \
        libpcre3-dev \
        unzip \
    && bash /tmp/install.sh \
        --assume-yes \
        --additional-nginx-configure-arguments "$NGINX_PARAM" \
        --nginx-version $NGINX_VERSION  \
    && apt-get clean

ARG USER_ID=1000
ARG GROUP_ID=500

RUN addgroup --quiet --gid=$GROUP_ID docker && \
    adduser --quiet --uid=$USER_ID --gid=$GROUP_ID docker && \
    umask 0027
    
ADD ./nginx.conf /etc/nginx/nginx.conf

ADD ./docker-entrypoint.sh /bin/docker-entrypoint.sh

RUN chmod 755 /bin/docker-entrypoint.sh
EXPOSE 8443 8080
RUN rm /etc/localtime \
    && cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime
VOLUME ["/www"]
VOLUME ["/var/log/nginx"]
ENTRYPOINT ["/bin/docker-entrypoint.sh"]
CMD ["nginx", "-c", "/etc/nginx/nginx.conf", "-g", "daemon off;"]
