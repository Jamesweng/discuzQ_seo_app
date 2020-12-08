FROM trafex/alpine-nginx-php7:latest

ENV APP_DIR /data/app/discuzQ_seo

USER root
RUN apk --no-cache add php7-tokenizer

WORKDIR $APP_DIR

COPY --chown=nobody:nobody ./ $APP_DIR

USER nobody
