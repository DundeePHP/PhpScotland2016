FROM andykirkham/base-docker-crossbar:latest
RUN mkdir -p /var/www/html/crossbar
COPY src /var/www/html/crossbar/
RUN chown -R www-data:www-data /var/www/html
WORKDIR /var/www/html/crossbar
EXPOSE 9090
EXPOSE 26699
ENTRYPOINT ["/opt/crossbar/bin/crossbar", "start", "--cbdir", "/var/www/html/crossbar/crossbar"]


