FROM php:8.0.2-alpine

COPY . /application
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN apk add --no-cache git

WORKDIR /application

RUN composer i
RUN chmod a+x bin/pisac
RUN chmod a+x entrypoint.sh

ENTRYPOINT ["/application/entrypoint.sh"]
