FROM registry.access.redhat.com/ubi8/php-73:1-72

USER root

# Add Utilities
RUN yum install -y git nano curl;

# Install xdebug
# RUN yum install -y php-xdebug; \
#     sed -i s^zend_extension=xdebug.so^zend_extension=/usr/lib64/php/modules/xdebug.so^g /etc/php.d/15-xdebug.ini; \
#     ini_file=/etc/php.d/15-xdebug.ini; \
#     echo "xdebug.remote_enable = true" >> $ini_file; \
#     echo "xdebug.remote_autostart = true" >> $ini_file; \
#     echo "xdebug.remote_host = 'host.docker.internal'" >> $ini_file; \
#     echo "xdebug.remote_port = 9000" >> $ini_file; \
#     echo "xdebug.remote_log = /var/log/xdebug.log" >> $ini_file; \
#     echo "xdebug.max_nesting_level = 250" >> $ini_file; \
#     touch /var/log/xdebug.log; \
#     chmod 666 /var/log/xdebug.log;

# https://catalog.redhat.com/software/containers/rhel8/php-74/5f5211e39df2542e4756afd1
COPY . /tmp/src
RUN /usr/libexec/s2i/assemble
RUN chown default:root /opt/app-root/src -R
USER default

CMD /usr/libexec/s2i/run
