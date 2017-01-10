.PHONY: all up restart stop clean php mysql nginx

UID=$(shell id -u)
GID=$(shell id -g)

# Executable
PHP=docker-compose exec --user www-data php
NGINX=docker-compose exec nginx
MYSQL=docker-compose exec mysql

all: php

up:
	docker-compose up -d

restart: stop up

stop:
	docker-compose stop

clean: stop
	docker-compose rm -f

php:
	$(PHP) /bin/bash

nginx:
	$(NGINX) /bin/bash

mysql:
	$(MYSQL) mysql -uphalcon-start -pphalcon-start phalcon-start

