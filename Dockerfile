FROM php:8.0.2-alpine

COPY ./pisac.phar .

ENTRYPOINT ["/pisac.phar"]
