build:
	HOST_UID=$(shell id -u) HOST_GID=$(shell id -g) docker compose -f ./compose.yml build --no-cache --force-rm

up:
	HOST_UID=$(shell id -u) HOST_GID=$(shell id -g) docker compose -f ./compose.yml up -d

stop:
	HOST_UID=$(shell id -u) HOST_GID=$(shell id -g) docker compose -f ./compose.yml stop

down:
	HOST_UID=$(shell id -u) HOST_GID=$(shell id -g) docker compose -f ./compose.yml down -v

# Testing

up-test:
	docker compose -f ./compose.test.yml --env-file .env.testing up -d --wait

down-test:
	docker compose -f ./compose.test.yml --env-file .env.testing down -v

test-unit:
	@php artisan test --testsuite=Unit

test-feature:
	@trap 'make down-test' EXIT; \
	make up-test && \
	php artisan test --testsuite=Feature

coverage:
	@trap 'make down-test' EXIT; \
	make up-test && \
	php artisan test --coverage --coverage-clover=coverage/coverage.xml
