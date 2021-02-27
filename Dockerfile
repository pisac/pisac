FROM php:8.0.2-alpine

COPY . /application
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN apk add --no-cache git

WORKDIR /application

RUN composer i
RUN chmod +x bin/pisac

ENTRYPOINT ["bin/pisac"]
