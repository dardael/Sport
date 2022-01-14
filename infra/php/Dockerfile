FROM php:8.0.0RC3-fpm-alpine
RUN apk --update --no-cache add git
RUN docker-php-ext-install pdo_mysql
COPY --from=composer /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
CMD composer install ;  php-fpm
EXPOSE 9000

# XDebug extension
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo 'xdebug.mode=develop,debug,profile,trace,coverage' >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini \
    && echo 'xdebug.start_with_request=trigger' >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini \
    && echo 'xdebug.profiler_output_name=callgrind.ou²t.%u%s.cgr' >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini \
    && echo 'xdebug.idekey=PHPSTORM' >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini \
    && echo 'xdebug.client_port=9003' >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini \
    && echo 'xdebug.remote_handler=dbgp' >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.discover_client_host=1" >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini \
    && echo 'xdebug.debug.output_dir=/usr/local/logs/php' >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini