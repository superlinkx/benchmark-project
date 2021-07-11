#!/bin/bash
echo "Host: ${FASTCGI_HOST}"
envsubst '${FASTCGI_HOST}' < /etc/nginx/conf.d/default.conf.template > /etc/nginx/conf.d/default.conf
exec "$@"