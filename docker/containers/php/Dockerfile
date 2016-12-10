FROM phpdockerio/php7-fpm:latest



RUN apt-get update \
	&& apt-get install -y \
		curl \
        wget \
        cron \
        vim \
        gcc \
        git \
        libpcre3-dev \
        libuv-dev \
        libgmp-dev \
        make \
        cmake \
        openssh-server

RUN curl -s https://packagecloud.io/install/repositories/phalcon/stable/script.deb.sh | bash

RUN apt-get -y --no-install-recommends install  \
        php7.0-mysql \
        php7.0-redis \
        php7.0-gd \
        php7.0-geoip \
        php7.0-ssh2 \
        php7.0-xdebug \
        php7.0-phalcon \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php \
    && php composer-setup.php --install-dir=/usr/bin --filename=composer\
    && php -r "unlink('composer-setup.php');"

RUN mkdir -p /var/www && chown www-data:www-data /var/www -R
