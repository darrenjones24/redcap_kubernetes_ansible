#########
# STAGE #
#########
FROM php:7-apache AS build-stage
LABEL maintainer="dmj24@sussex.ac.uk"
RUN apt-get update && apt-get install -y unzip
# Redcap zip file must be downloaded and present in this directory
COPY *.zip /tmp/redcap.zip
RUN unzip /tmp/redcap.zip -d /tmp/
COPY database.php /tmp/redcap/database.php
#########
# FINAL #
#########
FROM php:7-apache
ENV PACKAGES="libpng-dev libzip-dev msmtp curl  default-mysql-client tini"
COPY --from=build-stage /tmp/redcap/ /var/www/html/
COPY php.ini /usr/local/etc/php/
RUN apt-get update -qq \
    && apt-get -yq --no-install-recommends install $PACKAGES \
    && docker-php-ext-install gd zip mysqli \
    && docker-php-source delete \
    && rm -r /var/lib/apt/lists/* \
    && sed -i 's/VirtualHost \*:80/VirtualHost \*:8080/' /etc/apache2/sites-enabled/000-default.conf \
    && sed -i 's/80/8080/g' /etc/apache2/ports.conf \
    && mkdir /var/www/html/temp -p \
    && mkdir /edocs/ \
    && chmod 777 -R /var/www/html/temp/ \
    && chown -R www-data:www-data /edocs/ \
 	  && chown -R www-data:www-data /var/www/html/ \
    && echo 'sendmail_path = "/usr/bin/msmtp -t -i"' > /usr/local/etc/php/conf.d/mail.ini
USER 33
EXPOSE 8080
ENTRYPOINT ["/usr/bin/tini", "--"]
CMD ["apache2ctl", "-D","FOREGROUND"]
