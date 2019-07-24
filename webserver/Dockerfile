FROM andykirkham/base-docker-php7-apache:latest
COPY src /var/www/html
RUN chown -R www-data:www-data /var/www/html
RUN chmod 775 /var/www/html
WORKDIR /var/www/html
RUN composer clearcache && composer --verbose install
RUN sed -i "s@/var/www/html@/var/www/html/public@g" /etc/apache2/sites-available/000-default.conf
CMD ["apachectl","-DFOREGROUND"]

