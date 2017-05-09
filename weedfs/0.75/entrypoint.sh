#!/bin/sh
set -e

# allow the container to be started with `--user`
if [ "$1" = 'weed' -a "$(id -u)" = '0' ]; then
	chown -R weedfs .
	exec su-exec weedfs "$0" "$@"
fi

exec "$@"