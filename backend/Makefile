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
	docker compose -f ./compose.test.yml up -d --wait

down-test:
	docker compose -f ./compose.test.yml down -v

test-unit:
	@php artisan test --testsuite=Unit

test-feature:
	@trap 'make down-test' EXIT; \
	make up-test && \
	php artisan test --testsuite=Feature

test:
	@trap 'make down-test' EXIT; \
	make up-test && \
	php artisan test
