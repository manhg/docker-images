#!/bin/sh
cd /etc/nginx/ssl/
openssl genrsa -des3 -passout pass:x -out server.pass.key 2048
openssl rsa -passin pass:x -in server.pass.key -out server.key
rm server.pass.key
openssl req -new -key server.key -out server.csr -subj "/C=JP/ST=Tokyo/L=Tokyo/O=app/OU=app.local/CN=app.local"
openssl x509 -req -sha256 -days 300065 -in server.csr -signkey server.key -out server.crt
exec "$@"
