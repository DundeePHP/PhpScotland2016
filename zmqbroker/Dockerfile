FROM andykirkham/base-docker-php7-cli:latest
RUN mkdir -p /var/www/html/
COPY src /var/www/html/
RUN chown -R www-data:www-data /var/www/html
WORKDIR /var/www/html/public
EXPOSE 26688
EXPOSE 26699
CMD ["php", "/var/www/html/public/app.php"]
