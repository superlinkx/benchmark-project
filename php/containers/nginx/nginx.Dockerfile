FROM nginx:latest
ENV FASTCGI_HOST=127.0.0.1:9000
COPY config/nginx/nginx.conf /etc/nginx/nginx.conf
COPY config/nginx/conf.d/default.conf.template /etc/nginx/conf.d/default.conf.template
COPY config/nginx/entrypoint.sh /entrypoint.sh
COPY src/ /var/www/html
ENTRYPOINT [ "/entrypoint.sh" ]
CMD ["nginx", "-g", "daemon off;"]