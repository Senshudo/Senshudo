FROM caddy:builder-alpine AS caddy-builder

RUN apk update && \
    apk add cmake \
    argon2-dev \
    brotli-dev \
    gcc \
    musl-dev && \
    CGO_ENABLED=1

COPY --from=golang:latest /usr/local/go /usr/local/go

ENV PATH=/usr/local/go/bin:$PATH

RUN xcaddy build

FROM ubuntu:24.04

LABEL maintainer="Stewart Marsh"

ARG WWWGROUP
ARG NODE_VERSION=22
ARG MYSQL_CLIENT="mysql-client"
ARG POSTGRES_VERSION=17

WORKDIR /var/www/html

# When updating the PHP version, please also update the following:
# - Caddyfile php-fpm socket
# - fpm-pool.conf
# - supervisord.conf
ENV PHP_VERSION="8.4"

ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=UTC
ENV COMPOSER_CACHE_DIR=/composer/cache
ENV COMPOSER_HOME=/composer
ENV XDG_CONFIG_HOME=/caddy/config
ENV XDG_DATA_HOME=/caddy/data

COPY --from=caddy-builder /usr/bin/caddy /usr/bin/caddy

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN echo "Acquire::http::Pipeline-Depth 0;" > /etc/apt/apt.conf.d/99custom && \
    echo "Acquire::http::No-Cache true;" >> /etc/apt/apt.conf.d/99custom && \
    echo "Acquire::BrokenProxy    true;" >> /etc/apt/apt.conf.d/99custom

RUN apt-get update && apt-get upgrade -y \
    && mkdir -p /etc/apt/keyrings \
    && apt-get install -y gnupg gosu curl software-properties-common ca-certificates zip unzip git supervisor sqlite3 libcap2-bin libpng-dev python3 dnsutils librsvg2-bin fswatch ffmpeg nano  \
    && curl -sS 'https://keyserver.ubuntu.com/pks/lookup?op=get&search=0xb8dc7e53946656efbce4c1dd71daeaab4ad4cab6' | gpg --dearmor | tee /etc/apt/keyrings/ppa_ondrej_php.gpg > /dev/null \
    && echo "deb [signed-by=/etc/apt/keyrings/ppa_ondrej_php.gpg] https://ppa.launchpadcontent.net/ondrej/php/ubuntu noble main" > /etc/apt/sources.list.d/ppa_ondrej_php.list \
    && apt-get update \
    && apt-get install -y \
      php${PHP_VERSION}-cli \
      php${PHP_VERSION}-dev \
      php${PHP_VERSION}-pgsql \
      php${PHP_VERSION}-sqlite3 \
      php${PHP_VERSION}-gd \
      php${PHP_VERSION}-fpm \
      php${PHP_VERSION}-curl \
      php${PHP_VERSION}-mongodb \
      php${PHP_VERSION}-imap \
      php${PHP_VERSION}-mysql \
      php${PHP_VERSION}-mbstring \
      php${PHP_VERSION}-xml \
      php${PHP_VERSION}-zip \
      php${PHP_VERSION}-bcmath \
      php${PHP_VERSION}-soap \
      php${PHP_VERSION}-intl \
      php${PHP_VERSION}-readline \
      php${PHP_VERSION}-ldap  \
      php${PHP_VERSION}-msgpack \
      php${PHP_VERSION}-igbinary \
      php${PHP_VERSION}-redis \
      php${PHP_VERSION}-memcached  \
      php${PHP_VERSION}-pcov  \
      php${PHP_VERSION}-imagick  \
      php${PHP_VERSION}-xdebug  \
      php${PHP_VERSION}-swoole \
    && curl -sLS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer \
    && curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg \
    && echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_$NODE_VERSION.x nodistro main" > /etc/apt/sources.list.d/nodesource.list \
    && apt-get update \
    && apt-get install -y nodejs \
    && npm install -g npm@latest \
    && curl -sS https://www.postgresql.org/media/keys/ACCC4CF8.asc | gpg --dearmor | tee /etc/apt/keyrings/pgdg.gpg >/dev/null \
    && echo "deb [signed-by=/etc/apt/keyrings/pgdg.gpg] https://apt.postgresql.org/pub/repos/apt noble-pgdg main" > /etc/apt/sources.list.d/pgdg.list \
    && apt-get update \
    && apt-get install -y $MYSQL_CLIENT \
    && apt-get install -y postgresql-client-$POSTGRES_VERSION \
    && apt-get update \
    && apt install chromium-browser -y \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN setcap "cap_net_bind_service=+ep" /usr/bin/php${PHP_VERSION}

RUN userdel -r ubuntu
RUN groupadd --force -g $WWWGROUP sail
RUN useradd -ms /bin/bash --no-user-group -g $WWWGROUP -u 1337 sail

COPY Caddyfile /etc/caddy/Caddyfile
COPY fpm-pool.conf /etc/php/${PHP_VERSION}/php-fpm.d/www.conf
COPY php.ini /etc/php/${PHP_VERSION}/cli/conf.d/99_php.ini
COPY xdebug.ini /etc/php/${PHP_VERSION}/cli/conf.d/99_xdebug.ini
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN mkdir -p mkdir /var/www/html /tmp/psysh /.local /.config ${COMPOSER_CACHE_DIR} ${XDG_CONFIG_HOME} ${XDG_DATA_HOME}
RUN chmod -R ugo+rw ${COMPOSER_CACHE_DIR}

RUN touch /var/log/php${PHP_VERSION}-fpm.log && \
    touch /var/log/php${PHP_VERSION}-fpm-www.slow.log && \
    touch /var/log/php${PHP_VERSION}-fpm-cli.slow.log

EXPOSE 80/tcp
EXPOSE 443/tcp
EXPOSE 2019/tcp
EXPOSE 9003/tcp

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
