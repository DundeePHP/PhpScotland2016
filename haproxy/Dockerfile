FROM haproxy:1.6
RUN mkdir -p /opt/keys
COPY server.pem /opt/certs/server.pem
COPY haproxy.cfg /usr/local/etc/haproxy/haproxy.cfg
COPY haproxy.cfg /etc/haproxy/haproxy.cfg

