FROM nginx:alpine
WORKDIR /var/www
CMD ["nginx"]
EXPOSE 80
VOLUME /var/log/nginx

RUN ln -sf /dev/stdout /var/log/nginx/access.log \
    && ln -sf /dev/stderr /var/log/nginx/error.log
