#!/bin/sh
if [ $PAGESPEED_CACHE ]; then
    mount -t tmpfs -o size=$PAGESPEED_CACHE tmpfs /mnt/pagespeed_cache
fi

if [ ! -f /etc/nginx/server.key ]; then
    cd /etc/nginx/
    openssl req  -nodes -new -x509 -keyout server.key -out server.crt -subj  "/C=JP/ST=Tokyo"
fi
exec "$@"
