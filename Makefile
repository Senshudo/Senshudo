env ?= ./.env
-include $(env)
ifdef $(env)
	$(shell sed 's/=.*//' $(env))
endif

.PHONY: help

help:
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.DEFAULT_GOAL := help
BRANCH := $(shell git rev-parse --abbrev-ref HEAD)

setup:
	if ! [ -f .env ]; then cp .env.example .env; fi
	if ! [ -x "`command -v docker`" ]; then echo 'Please ensure Docker is installed'; fi
	if ! [ -x "`command -v npm`" ]; then echo 'Please ensure Node is installed'; fi
	make composer_install
	npm ci
	@if ! docker image inspect senshudo >/dev/null 2>&1; then make sail_build; fi
	make sail_up
	./vendor/bin/sail artisan key:generate
	make db_reset
	make ide_helper
	make setup_ssl_hosts

sail_build:
	@echo "Building Sail containers..."
	./vendor/bin/sail build --no-cache

sail_up:
	@echo "Starting Sail containers..."
	./vendor/bin/sail up -d

composer_install:
	@echo "Installing Composer dependencies..."
	@if command -v php >/dev/null 2>&1 && php -v | grep -q 'PHP 8.4'; then \
		composer install --ignore-platform-reqs; \
	else \
		docker run --rm -u "$(shell id -u):$(shell id -g)" -v "$(shell pwd):/var/www/html" -w /var/www/html laravelsail/php84-composer:latest composer install --ignore-platform-reqs; \
	fi

db_reset:
	@echo "Resetting the database..."
	./vendor/bin/sail artisan migrate:fresh --seed
	./vendor/bin/sail artisan octane:reload

ide_helper:
	@echo "Generating IDE helper files..."
	./vendor/bin/sail artisan ide-helper:generate
	./vendor/bin/sail artisan ide-helper:meta

setup_ssl_hosts:
	@echo "Setting up SSL & Hosts..."
	./scripts/setup.sh
