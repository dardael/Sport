FROM php:8.0.5-fpm-alpine
RUN apk --update --no-cache add git
COPY --from=composer /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
CMD composer install ;  php-fpm
EXPOSE 9000

#pickle
RUN set -ex \
    && apk --no-cache add pcre-dev ${PHPIZE_DEPS} \ 
	&& apk add --update libzip-dev \
	&& docker-php-ext-install -j$(nproc) zip \
	&& curl -L -o /usr/local/bin/pickle https://github.com/FriendsOfPHP/pickle/releases/download/v0.7.0/pickle.phar \
	&& chmod +x /usr/local/bin/pickle

# XDebug extension
RUN pickle install xdebug \
    && echo 'xdebug.mode=develop,debug,profile,trace,coverage' >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini \
    && echo 'xdebug.start_with_request=trigger' >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini \
    && echo 'xdebug.profiler_output_name=callgrind.ou²t.%u%s.cgr' >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini \
    && echo 'xdebug.idekey=PHPSTORM' >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini \
    && echo 'xdebug.client_port=9003' >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini \
    && echo 'xdebug.remote_handler=dbgp' >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.discover_client_host=1" >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini \
    && echo 'xdebug.debug.output_dir=/usr/local/logs/php' >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini

#mongoDb
RUN echo "--with-openssl-dir=yes" >> opts \
    && pickle install --with-configure-options=opts mongodb \
    && echo "extension=mongo.so" > /usr/local/etc/php/conf.d/mongo.ini
