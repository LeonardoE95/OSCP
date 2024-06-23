FROM php:7.2-fpm

RUN apt-get update -y
RUN apt-get install -y nginx

COPY nginx/default.conf /etc/nginx/sites-enabled/default
COPY nginx/prod.conf /etc/nginx/sites-enabled/prod
COPY entrypoint.sh /etc/entrypoint.sh

COPY --chown=www-data:www-data www/html/. /var/www/html/
COPY --chown=www-data:www-data www/prod/. /var/www/prod/

EXPOSE 80 443

ENTRYPOINT ["sh", "/etc/entrypoint.sh"]