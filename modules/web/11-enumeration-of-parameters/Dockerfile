FROM php:7.2-fpm

RUN apt-get update -y
RUN apt-get install -y nginx

COPY nginx/default.conf /etc/nginx/sites-enabled/default
COPY entrypoint.sh /etc/entrypoint.sh

COPY --chown=www-data:www-data www/html/. /var/www/html/

EXPOSE 80 443

ENTRYPOINT ["sh", "/etc/entrypoint.sh"]