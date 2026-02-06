build:
	HOST_UID=$(shell id -u) HOST_GID=$(shell id -g) docker compose -f ./compose.yml build --no-cache --force-rm

up:
	HOST_UID=$(shell id -u) HOST_GID=$(shell id -g) docker compose -f ./compose.yml up -d

stop:
	HOST_UID=$(shell id -u) HOST_GID=$(shell id -g) docker compose -f ./compose.yml stop

down:
	HOST_UID=$(shell id -u) HOST_GID=$(shell id -g) docker compose -f ./compose.yml down -v